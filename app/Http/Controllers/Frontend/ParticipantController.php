<?php

namespace App\Http\Controllers\Frontend;

use App\Model\EventMaster;
use App\Model\EventParticipant;
use App\Model\EventParticipantsAsset;
use App\Model\EventParticipantsMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use PhpParser\Node\Stmt\Return_;

class ParticipantController extends Controller
{
    public function index(Request $request){
        $participant_teams = EventParticipant::where('event_id','=',$request->id)->get();


        foreach($participant_teams as $key => $team){
            $assets = EventParticipantsAsset::where('event_p_id','=',$team['id'])->get();
            $team['assets'] = $assets->toArray();
        }

        $event = EventMaster::where('id','=',$request->id)->first()->toArray();
//        dd($event);

        return view('frontend.participants',compact('participant_teams','event'));
    }

    public function details(Request $request){
        $participant_details = EventParticipant::where('id','=',$request->id)->first();
//dd($request->id);
        $details = $participant_details->toArray();

        $assets = EventParticipantsAsset::where('event_p_id','=',$request->id)->get();
        $details['assets'] = $assets->toArray();
        //dd($details);
        $member = EventParticipantsMember::select('name')->where('event_id',$details['event_id'])->where('event_p_id',$request->id)->get();
        $details['members'] = $member->toArray();
//    dd($details['event_id']);
        $event = EventMaster::where('id','=',$details['event_id'])->first();

        return view('frontend.participants_details',compact('details','event'));
    }


    public function result($event_id){
        $event = EventMaster::where('id','=',$event_id)->first();

        $winners = EventParticipant::where('event_id',$event_id)->where('vote_count','<>',0)
            ->orderBy('vote_count', 'desc')
            ->take(2)
            ->get();
//            die($winners);
        foreach($winners as $winner){
            $member = EventParticipantsMember::select('name')->where('event_id',$winner->event_id)->where('event_p_id',$winner->id)->get();
            $winner['members'] = $member->toArray();
            $assets = EventParticipantsAsset::where('event_p_id','=',$winner->id)->get();
            $winner['assets'] = $assets->toArray();
        }
//dd($winners);
        return view('frontend.event_result',compact('event','winners'));

    }

    public function verificationForUploadAssets(Request $request){

        $event_details = EventMaster::where('id',$request->id)->first();
//        session()->flush();

//        dd($event_details);
        return view('frontend.verification_upload_assets',compact('event_details'));
    }

    public function sendOtpForUpload(Request $request){
        if($request->ajax()){
//            session()->flush();
            if(!$request->resend_flag) {
                if ($this->validate($request,
                    ['email' => 'required|email', 'password' => 'required'])) {

//                    session()->flush();

                    $members = EventParticipantsMember::select('email','event_p_id','event_id')
                        ->where('event_id',$request->event_id)->where('email',$request->email)->first();

                    if($members) {
//                        return $members['event_p_id'];
                        session(['password'=>$request->password]);
                        $otp = mt_rand(1000, 9999);
                        $result = $this->neovalidate($request->email,$request->password,$otp);
                        $result = json_decode($result,true);

                        if($result['is_valid']){
                            session(['user_email'=>$request->email]);
                            session(['otp'=>1]);
                            session(['otpcode'=>$otp]);
                            return response()->json(array(
                                'success' => true,
                                'event_id'=> $request->event_id,
                                'event_p_id'=> $members['event_p_id'],
                                'message' => $result['message']

                            ));
                        }else{
                            return response()->json(array(
                                'success' => false,
                                'message' => $result['message']
                            ));
                        }
                    }
                    else{
                        return response()->json(array(
                            'success' => false,
                            'message' => 'Sorry, You have not register for this event'
                        ));

                    }
                }else{
                    return response()->json(array(
                        'success' => false,
                        'errors' => $this->validate->getMessageBag()->toArray()
                    ));
                }
            }else{

                $otp = mt_rand(1000, 9999);
                $email= session()->get('user_email');
                $password = session()->get('password');
                $result = $this->neovalidate($email,$password,$otp);
                $result = json_decode($result,true);
                if($result['is_valid']){
                    session(['otp'=>1]);
                    session(['otpcode'=>$otp]);
                        return response()->json(array(
                            'success' => true,
                            'message'=>'OTP resent to your mobile. Please enter sent otp below.'
                        ));
                }else{
                    return response()->json(array(
                        'success' => false,
                        'message' => $result['message']
                    ));
                }
            }
        }
    }

    public function otpVerification(Request $request)
    {
        if($request->ajax()){

            if($this->validate($request,[
                'otp' => 'required|numeric|digits:4',
            ])){
                $email = session()->get('user_email');
                $otpcode = session()->get('otpcode');

                $members = EventParticipantsMember::select('email','event_p_id','event_id')
                    ->where('event_id',$request->event_id)->where('email',$email)->first();
                if($otpcode == $request->otp){
                    session()->forget('otp');
                    session(['event_p_id'=> $members['event_p_id']]);

                    return response()->json(array(
                        'success' => true,
                        'event_p_id'=> $members['event_p_id'],
                        'event_id'=> $request->event_id,
                    ));
                }
                else{
                    return response()->json(array(
                        'success' => false,
                        'wrong_otp'=>'Entered wrong OTP.'
                    ));
                }
            }
            else{
                return response()->json(array(
                    'success' => false,
                    'errors' => $this->validate->getMessageBag()->toArray()
                ));
            }
        }
    }

    public function neovalidate($email,$password,$otp){
        $url = 'http://services.neosofttech.in/events/sendotp.php';
        $ch = curl_init( $url );
        $payload = array( "email"=> $email,"password"=> $password,"otp"=> $otp);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function uploadAssetsForm(Request $request){

        $event = EventMaster::where('id',$request->id)->first();

        return view('frontend.upload_assets',compact('event'));

    }

    public function uploadAssets(Request $request){
//        die('in upload contro');

//
        $members =  EventParticipantsMember::select('email','event_p_id','event_id')
            ->where('event_id',$request->event_id)->where('email',$request->event_p_email)->first();
        $current_time = time();

        if($request->asset_type == "image"){

            if($this->validate($request,[
                'images' => 'required',
            ])) {

                EventParticipantsAsset::where('event_p_id',$members['event_p_id'])->delete();
                $images = Input::file('images');
                $destinationPath = public_path().'/uploads/';
                $assets = EventParticipantsAsset::where('event_p_id',$members['event_p_id'])->get();
                $totalAssets = sizeof($assets->toArray());

                if($totalAssets <= 4){
                    foreach ($images as $image){
                        $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                        $unique_image_name = $filename . '_' . $current_time . '.' . $image->getClientOriginalExtension();
                        $image->move($destinationPath, $unique_image_name);
                        $EventParticipantsAsset = new EventParticipantsAsset();
                        $EventParticipantsAsset->event_p_id = $members['event_p_id'];
                        $EventParticipantsAsset->asset_type =  $request->asset_type;
                        $EventParticipantsAsset->assets = $unique_image_name;
                        $EventParticipantsAsset->save();
                    }
                }else{
                    session()->forget('user_email');
                    return redirect('participants/uploadform/'.$request->event_id."/".$members['event_p_id'])->with('failed', 'You already have 4 assets.so you cannot upload more.');

                }
            }
        }
        if($request->asset_type == "video") {
            if ($this->validate($request, [
                'video' => 'required',
            ])) {
                EventParticipantsAsset::where('event_p_id',$members['event_p_id'])->delete();
                $EventParticipantsAsset = new EventParticipantsAsset();
                $EventParticipantsAsset->event_p_id = $members['event_p_id'];
                $EventParticipantsAsset->asset_type =  $request->asset_type;
                $EventParticipantsAsset->assets = "https://www.youtube.com/embed/".trim($request->video);
                $EventParticipantsAsset->save();
                session()->forget('user_email');
            }
        }
        session()->forget('user_email');
        session()->forget('otpcode');
        session()->forget('password');
        session()->forget('event_p_id');

        return redirect('participants/details/'.$members['event_p_id'])->with('success', 'Assets Upload Successfully.');
    }
}