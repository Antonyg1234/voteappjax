<?php

namespace App\Http\Controllers\Frontend;

//include(app_path().'/Services/nusoap.php');

use App\Model\EventParticipant;
use App\Model\EventParticipantsAsset;
use App\Model\Vote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use session;
use DB;
use App\Services\nusoap_client;



class VoteController extends Controller
{
    public function index(Request $request){

        $event_participant = EventParticipant::from('event_participants as ep')
            ->join('event_masters as em','em.id','=','ep.event_id')
            ->select('ep.id as participants_id','em.id as event_id','em.title as event_title','em.description as description','ep.team_name')
            ->where('ep.id','=',$request->id)->first();
        //dd($event_participant->toArray());
        return view('frontend.vote',compact('event_participant'));
    }

//    public function test(){
//
//        $client = new nusoap_client("http://services.neosofttech.in/webservices/send_otp_for_events.php");
//        $error = $client->getError();
//        if ($error) {
//            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
//            exit;
//        }
//
////sending request and receiving response4
//        $arrEvent = $client->call("Authenticate_Login", array("parameter" => "authenticate", 'emailAddress' => 'akash.malik@wwindia.com', 'password' => 'neoworld2o16', 'otp' => 4325));
//        dd(array($arrEvent,$client));
//        exit;
//
//
//    }

    public function sendOtp(Request $request){

        if ($request->ajax()) {
            if(!$request->resend_flag){
                if ($this->validate($request,
                    ['email' => 'required|email' ])) {

                    $vote = Vote::select('vote')->where('event_id',$request->event_id)->where('email',$request->email)->first();

                    //api call
//                    $client = new nusoap_client("http://services.neosofttech.in/webservices/send_otp_for_events.php");
//
//                    $arrEvent = $client->call("Authenticate_Login", array("parameter" => "authenticate", 'emailAddress' => $request->email, 'password' => $request->password));


                    //echo "api called and we got otp as response";
                    if(!$vote){
                        $otp = '12345';
                        if($otp != ''){
                            $voterDeatails = array();
                            $voterDeatails['email'] = $request->email;
                            $voterDeatails['event_id'] = $request->event_id;
                            $voterDeatails['event_p_id'] = $request->event_p_id;
                            $voterDeatails['otp'] = $otp;
                            Vote::create($voterDeatails);
                            session(['otp'=>1]);
                            session(['user_email'=>$request->email]);


                            return response()->json(array(
                                'success' => true,
                                'message'=>'OTP sent to your mobile. Please enter sent otp below.'
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
                //api call
                //echo "api called and we got otp as response";
                    $otp = '546899';
                    if($otp != ''){
                        Vote::where('event_id', '=', $request->event_id)
                            ->where('event_p_id','=',$request->event_p_id)
                            ->update(array('otp' => $otp));

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

            }
        }
    }

    public function otp(Request $request)
    {
        if($request->ajax()){
            if($this->validate($request,[
                'otp' => 'required|numeric|digits:6',
            ])){
                //api call for matched otp
                $email = session()->get('user_email');

                Vote::where('email', '=', $email)->update(array('vote' => '1','otp' => NULL));

                DB::table('event_participants')->where('id' , $request->event_p_id)->where('event_id' , $request->event_id)->increment('vote_count', 1);

                session()->forget('otp');
                session()->forget('user_email');
                $request->session()->flash('success', 'You have been voted successfully for event.');
                $request->session()->flash('message-type', 'success');
                return response()->json(array(
                    'success' => true,
                    'event_id'=> $request->event_id,
                    'message'=>'You have voted successfully'                ));
            }
            else{
                return response()->json(array(
                    'success' => false,
                    'errors' => $this->validate->getMessageBag()->toArray()

                ));
            }
        }

//        session()->forget('otp');
//
//        return back()->with('success','you have voted successfully');
    }




}