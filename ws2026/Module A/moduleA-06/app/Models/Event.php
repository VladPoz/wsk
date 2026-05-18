<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = ['title', 'description', 'location', 'event_date', 'capacity'];

    public function confirmed_registrations(){
        return $this->hasMany(Registration::class)->where('status', 'CONFIRMED');
    }

    public function myRegistratons(){
        return $this->hasMany(Registration::class)->where('participant_id', auth()->user()->myParticipant->id);
    }
}
