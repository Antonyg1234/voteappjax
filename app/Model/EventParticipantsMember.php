<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventParticipantsMember extends Model
{
    protected $table = 'event_participants_members';


    public function eventparticipant()
    {
        return $this->belongsTo('App\Model\EventParticipant','id');
    }
}
