<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    //
    protected $fillable = ['event_id', 'participant_id', 'status'];

    public function participant(){
        return $this->belongsTo(Participant::class);
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
