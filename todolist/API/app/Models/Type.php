<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
    public $timestamps = false;
    protected $table = "types";
    protected $primaryKey = "type_id";
    protected $fillable = [
        'name',
    ];
}
