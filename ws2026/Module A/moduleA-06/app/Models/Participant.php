<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    //
    protected $fillable = ['user_id', 'name', 'phone'];

    public function notCancelledRegistrations(){
        return $this->belongsTo(Registration::class)->where('status', 'CONFIRMED')->orWhere('status', 'PENDING');
    }
}
