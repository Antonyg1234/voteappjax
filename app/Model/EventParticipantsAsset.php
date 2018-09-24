<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventParticipantsAsset extends Model
{
    public function getAssetsAttribute($value) {

        if($this->attributes['asset_type'] == 'image'){
            $url = url('uploads/'.$value);
        }else{
            $url = $value;
        }
        return $url;
    }

    public function test(){
        return $this->belongsTo('App\Model\EventParicipant','event_p_id');
    }
}
