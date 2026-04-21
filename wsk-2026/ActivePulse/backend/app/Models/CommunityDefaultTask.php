<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityDefaultTask extends Model
{
    /** @use HasFactory<\Database\Factories\CommunityDefaultTaskFactory> */
    use HasFactory;

    protected $table = 'community_default_tasks';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'description',
        'count',
    ];
}
