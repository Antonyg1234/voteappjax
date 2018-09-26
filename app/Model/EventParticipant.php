<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    public function assets()
    {
        return $this->hasMany('App\Model\EventParticipantsAsset','event_p_id');
    }

    public function eventparticipantsmember()
    {
        return $this->hasMany('App\Model\EventParticipantsMember','event_p_id');
    }
}
