<?php

namespace App\Http\Controllers\Frontend;

use App\Model\EventParticipant;
use App\Model\EventParticipantsAsset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoteController extends Controller
{
    public function index(Request $request){
//        //return $request->id;
//        $assets = EventParticipantsAsset::join('event_participants','event_participants.id','=','event_participants_assets.event_p_id')
//            ->join('event_masters','event_masters.id','=','event_participants.event_id')
//            ->where('event_p_id','=',$request->id)->get();
//        dd($assets);

        $asset = EventParticipantsAsset::where('event_p_id','=',$request->id)->get();
        //dd($asset->toArray());
        return view('frontend.vote',compact('asset'));
    }

    public function display_popup(Request $request){
        $asset = EventParticipantsAsset::where('event_p_id','=',$request->id)->get();
    }
}
