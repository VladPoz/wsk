<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    //
    protected $table = 'adverts';
    protected $fillable = [
        'title',
        'text',
        'status',
        'price',
        'views_count',
        'category_id',
        'user_id',
        'photos',
        'paid_services',
    ];
    public $timestamps = false;
}
