<?php

namespace App\Model;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class EventMaster extends Model
{
    public function getEventDateAttribute($value) {
       $date = Carbon::parse($value)->format('j-F-Y');
       $time = Carbon::parse($value)->format('h:i A');

       $event_date = explode('-',$date);
       $event_time = explode(' ',$time);

       $date_time = array_merge($event_date,$event_time);

       return $date_time;
    }
}
