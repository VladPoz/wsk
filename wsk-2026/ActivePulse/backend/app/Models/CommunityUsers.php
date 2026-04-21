<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityUsers extends Model
{
    /** @use HasFactory<\Database\Factories\CommunityUsersFactory> */
    use HasFactory;

    protected $table = 'community_users';
    protected $fillable = [
        'community_id',
        'user_id',
    ];
}
