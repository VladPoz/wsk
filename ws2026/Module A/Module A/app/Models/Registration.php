<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    //
    protected $table = 'registrations';
    protected $fillable = [
        'event_id',
        'participant_id',
        'status',
    ];

    protected $visible = [
        'id',
        'event',
        'status',
        'event_id',
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
