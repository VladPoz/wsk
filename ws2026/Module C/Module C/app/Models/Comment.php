<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';
    protected $fillable = ['author', 'news_id', 'body', 'status'];

    public function news(){
        return $this->belongsTo(News::class);
    }
}
