<?php

namespace App\Http\Controllers\Frontend;

use App\Model\EventMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $future_events = EventMaster::where('event_date','>',Carbon::now())->orderby('event_date','asc')->get();
        $past_events = EventMaster::where('event_date','<',Carbon::now())->orderby('event_date','asc')->get();
        $upcoming_event_time = EventMaster::where('event_date','>',Carbon::now())->select('event_date as upcoming_time')->orderby('event_date','asc')->first();
        $upcoming_event_time = Carbon::parse($upcoming_event_time['upcoming_time'])->format('Y/m/d');
        return view('frontend.home',compact('future_events','past_events','upcoming_event_time'));
    }
}
