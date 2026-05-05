<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    //
    protected $table = 'polls';
    public $timestamps = false;
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'slug',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function questions(){
        return $this->hasMany(Question::class);
    }
}
