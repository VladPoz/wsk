<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    //
    protected $table = 'places';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'latitude',
        'longitude',
        'x',
        'y',
        'type',
        'image_path',
        'open_time',
        'close_time',
        'description',
    ];
}
