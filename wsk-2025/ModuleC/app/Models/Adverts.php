<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adverts extends Model
{
    //
    protected $table = 'adverts';
    protected $fillable = [
        'status',
        'title',
        'text',
        'price',
        'category_id',
        'user_id',
        'photos',
    ];
}
