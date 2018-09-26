<?php

namespace App\Http\Controllers\Frontend;

use App\Model\EventMaster;
use App\Model\EventParticipant;
use App\Model\EventParticipantsAsset;
use App\Model\EventParticipantsMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ParticipantController extends Controller
{
    public function index(Request $request){
        $participant_teams = EventParticipant::where('event_id','=',$request->id)->get();


        foreach($participant_teams as $key => $team){
            $assets = EventParticipantsAsset::where('event_p_id','=',$team['id'])->get();
            $team['assets'] = $assets->toArray();
        }

        $event = EventMaster::where('id','=',$request->id)->first();

        return view('frontend.participants',compact('participant_teams','event'));
    }

    public function details(Request $request){
        $participant_details = EventParticipant::where('id','=',$request->id)->first();

        $details = $participant_details->toArray();

        $assets = EventParticipantsAsset::where('event_p_id','=',$request->id)->get();
        $details['assets'] = $assets->toArray();
        //dd($details);
        $member = EventParticipantsMember::select('name')->where('event_id',$details['event_id'])->where('event_p_id',$request->id)->get();
        $details['members'] = $member->toArray();
    //dd($details);
        $event = EventMaster::where('id','=',$details['event_id'])->first();

        return view('frontend.participants_details',compact('details','event'));
    }


    public function result($event_id){
        $event = EventMaster::where('id','=',$event_id)->first();

        $winners = EventParticipant::where('event_id',$event_id)
            ->orderBy('vote_count', 'desc')
            ->take(2)
            ->get();

        foreach($winners as $winner){
            $member = EventParticipantsMember::select('name')->where('event_id',$winner->event_id)->where('event_p_id',$winner->id)->get();
            $winner['members'] = $member->toArray();
            $assets = EventParticipantsAsset::where('event_p_id','=',$winner->id)->get();
            $winner['assets'] = $assets->toArray();
        }
//dd($winners);
        return view('frontend.event_result',compact('event','winners'));

    }
}