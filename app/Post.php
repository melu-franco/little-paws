<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'content', 'user_id', 'image'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id', 'name');
    }

    public function likes()
    {
        return $this->belongsTo(Like::class, 'post_id','id');
    }
    public function likesCounter(){
        return $this->likes->count();
    }
}
