<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];
    public function published_count(){
        return Advert::query()->where('status', 'published')->where('category_id', $this->id)->count();
    }
}
