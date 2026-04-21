<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityTask extends Model
{
    /** @use HasFactory<\Database\Factories\CommunityTaskFactory> */
    use HasFactory;
    protected $table = 'community_tasks';
    public $timestamps = false;
    protected $fillable = [
        'community_id',
        'name',
        'description',
        'count',
    ];
}
