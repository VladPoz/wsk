<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service_usage extends Model
{
    //
    protected $table = 'service_usage';
    protected $fillable = [
        'name',
        'workspace_title',
        'api_token_name',
        'usage_duration_in_ms',
        'usage_started_at',
        'service_name',
        'service_cost_per_ms'
    ];
    public $timestamps = false;
}
