<?php

namespace App\Http\Controllers\Frontend;

use App\Model\EventParticipant;
use App\Model\EventParticipantsAsset;
use App\Model\Vote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use session;

class VoteController extends Controller
{
    public function index(Request $request){

        $event_participant = EventParticipant::from('event_participants as ep')
            ->join('event_masters as em','em.id','=','ep.event_id')
            ->select('ep.id as participants_id','em.id as event_id','em.title as event_title','ep.team_name')
            ->where('ep.id','=',$request->id)->first();
        //dd($event_participant->toArray());
        return view('frontend.vote',compact('event_participant'));
    }

    public function post(Request $request){

        if ($request->ajax()) {
            if ($this->validate($request,
                ['email' => 'required|email'])) {

                $vote = Vote::select('vote')->where('event_id',$request->event_id)->where('email',$request->email)->first();

                //print_r($vote);
                //echo $request->event_id ;die();
                //api call
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

                session()->forget('otp');
                session()->forget('user_email');

                return response()->json(array(
                    'success' => true,
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