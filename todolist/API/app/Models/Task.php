<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public $fillable = [
        'user_id',
        'title',
        'description',
        'priority',
        'type',
        'count',
        'count_completed',
        'completed',
    ];
}
