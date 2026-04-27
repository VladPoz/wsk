<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //
    protected $table = 'results';
    public $timestamps = false;
    protected $fillable = [
        'poll_id',
        'question_id',
        'answer_id',
        'count',
    ];
}
