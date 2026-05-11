<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Event extends Model
{
    //
    protected $table = 'events';
    protected $fillable = [
        'title',
        'description',
        'location',
        'event_date',
        'capacity',
    ];

    protected $visible = [
        'id',
        'title',
        'description',
        'location',
        'event_date',
        'capacity',
        'registrations_count',
        'participants',
    ];

    public function registrations(){
        return $this->hasMany('App\Models\Registration', 'event_id', 'id')->where('status', 'CONFIRMED');
    }

    public function participants(){
        $registration = $this->hasMany('App\Models\Registration', 'event_id', 'id')->where('status', 'CONFIRMED')->get('participant_id');
        $mass = [];
        foreach($registration as $r){
            $mass[] = Participant::query()->find($r->participant_id)->only(['id', 'name', 'phone']);
        }
        return $mass;
    }
}
