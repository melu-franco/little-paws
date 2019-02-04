<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\User;

class CommentController extends Controller
{
    public function store(Request $request, Comment $comment)
    {
        $comment->content = $request->get('content');
        $comment->user()->associate($request->user());
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);

        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back();
    }


}
