<?php

namespace App\Http\Controllers\Frontend;

use App\Model\EventParticipant;
use App\Model\EventParticipantsAsset;
use App\Model\Vote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use session;
use DB;

class VoteController extends Controller
{
    public function index(Request $request){
        $event_participant = EventParticipant::from('event_participants as ep')
            ->join('event_masters as em','em.id','=','ep.event_id')
            ->select('ep.id as participants_id','em.id as event_id','em.title as event_title','em.description as description','ep.team_name')
            ->where('ep.id','=',$request->id)->first();
        return view('frontend.vote',compact('event_participant'));
    }

    public function sendOtp(Request $request){
        if ($request->ajax()) {
            if(!$request->resend_flag){
                if ($this->validate($request,
                    ['email' => 'required|email','password'=> 'required' ])) {
                    $vote = Vote::select('vote')->where('event_id',$request->event_id)->where('email',$request->email)->first();
                    session(['password'=>$request->password]);
                    if(!$vote){
                        $otp = mt_rand(1000, 9999);
                        $result = $this->neovalidate($request->email,$request->password,$otp);
                        $result = json_decode($result,true);
                        if($result['is_valid']){
                            if($otp != ''){
                                $voterDeatails = array();
                                $voterDeatails['email'] = $request->email;
                                $voterDeatails['event_id'] = $request->event_id;
                                $voterDeatails['event_p_id'] = $request->event_p_id;
                                $voterDeatails['otp'] = $otp;
                                Vote::create($voterDeatails);
                                session(['otp'=> 1]);
                                session(['user_email'=>$request->email]);
                                return response()->json(array(
                                    'success' => true,
                                    'message'=> $result['message']
                                ));
                            }else {
                                return response()->json(array(
                                    'success' => false,
                                    'message' => 'OTP could not be sent.'
                                ));
                            }
                        }else{
                            return response()->json(array(
                                'success' => false,
                                'message' => $result['message']
                            ));
                        }
                    }else{
                        return response()->json(array(
                            'success' => false,
                            'voted' => 'Sorry, You have voted already.'
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
                    if($otp != ''){
                        Vote::where('event_id', '=', $request->event_id)
                            ->where('event_p_id','=',$request->event_p_id)
                            ->update(array('otp' => $otp));
                        session(['otp'=>1]);

                        return response()->json(array(
                            'success' => true,
                            'message'=>'OTP resent to your mobile. Please enter sent otp below.'
                        ));
                    }else {
                        return response()->json(array(
                            'success' => false,
                            'message' => 'OTP could not be sent.'

                        ));
                    }
                }else{
                    return response()->json(array(
                        'success' => false,
                        'message' => $result['message']
                    ));
                }
            }
        }
    }

    public function otp(Request $request)
    {
        if($request->ajax()){
            if($this->validate($request,[
                'otp' => 'required|numeric|digits:4',
            ])){
                $email = session()->get('user_email');
                $otp = Vote::select('otp')->where('email', '=', $email)->where('event_id' , $request->event_id)->first();
                if($otp->otp == $request->otp){
                    Vote::where('email', '=', $email)->update(array('vote' => '1','otp' => NULL));
                    DB::table('event_participants')->where('id' , $request->event_p_id)->where('event_id' , $request->event_id)->increment('vote_count', 1);
                    session()->forget('otp');
                    session()->forget('user_email');
                    $request->session()->flash('success', 'You have been voted successfully for event.');
                    $request->session()->flash('message-type', 'success');
                    return response()->json(array(
                        'success' => true,
                        'event_id'=> $request->event_id,
                        'message'=>'You have voted successfully'
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
}