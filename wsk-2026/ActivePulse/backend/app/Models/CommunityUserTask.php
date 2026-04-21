<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityUserTask extends Model
{
    /** @use HasFactory<\Database\Factories\CommunityUserTaskFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',

    ];
}
