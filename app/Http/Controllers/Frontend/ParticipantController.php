<?php

namespace App\Http\Controllers\Frontend;

use App\Model\EventMaster;
use App\Model\EventParticipant;
use App\Model\EventParticipantsAsset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ParticipantController extends Controller
{
    public function index(Request $request){
        $participant_teams = EventParticipant::where('event_id','=',$request->id)->get();


//        $participant_teams = DB::table('event_participants as ep')
//            ->join('event_participants_assets as epa','epa.event_p_id','=','ep.id')
//            ->where('ep.event_id','=',$request->id)
//            ->select('ep.id as ep_id','epa.id as epa_id','assets','asset_type','team_name','title','description','contact_person')
//            ->get();
//          $assets = array();
        foreach($participant_teams as $key => $team){
            $assets = EventParticipantsAsset::where('event_p_id','=',$team['id'])->get();
            $team['assets'] = $assets->toArray();
        }
        //dd($participant_teams->toArray());
        $event = EventMaster::where('id','=',$request->id)->first();
       // $assets = EventParticipantsAsset::where('event_p_id','=',$request->id)->get();
//        $assets = EventParticipant::with('assets')->find(4)->assets;
//        dd($assets->toArray());
//        dd($participant_teams->toArray());


        return view('frontend.participants',compact('participant_teams','event'));
    }
}
