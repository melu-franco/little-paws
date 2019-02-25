<?php

namespace App\Http\Controllers;
use App\User;
use App\Post;

use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function like(Request $request, Post $post, User $user) {
        

        $comment->comment = $request->get('comment');
        $comment->user()->associate($request->user());
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);

        return back();

    }

}
