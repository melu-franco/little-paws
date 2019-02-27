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
        return $this->hasMany(Like::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function likesCounter()
    {
        return $this->likes->count();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
