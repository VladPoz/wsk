<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    //
    protected $table = 'participants';
    protected $fillable = [
        'user_id',
        'name',
        'phone',
    ];
}
