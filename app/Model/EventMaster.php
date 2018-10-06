<?php

namespace App\Model;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class EventMaster extends Model
{
    public function getModifiedEventDateAttribute() {

        $value = $this->attributes['event_date'];
       $date = Carbon::parse($value)->format('j-F-Y');
       $time = Carbon::parse($value)->format('h:i A');

       $event_date = explode('-',$date);
       $event_time = explode(' ',$time);

       $date_time = array_merge($event_date,$event_time);

       return $date_time;
    }

    public function getVotingEndDateAttribute($value){
        $now = Carbon::now();
        //returning true if voting date over.
        if($value < $now){
            $date = array();
            $date['date'] = $value;
            $date['smaller'] = 1;
            return $date;
        }else{
            $date = array();
            $date['date'] = $value;
            $date['smaller'] = 0;
            return $date;
        }
    }

//    public function getEventDateAttribute($value) {
//        $date = Carbon::parse($value)->format('j-F-Y');
//        $time = Carbon::parse($value)->format('h:i A');
//
//        $event_date = explode('-',$date);
//        $event_time = explode(' ',$time);
//
//        $date_time = array_merge($event_date,$event_time);
//
//        return $date_time;
//    }
}
