<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Like;
use Auth;
use Validator;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(User $user)
    {
        $posts = Post::latest()->take(20)->get();
        return view('dashboard.index', compact('posts'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request, Post $post, User $user)
    {
        $user_id = auth()->user()->id;

        $this->validate($request, [
            'content' => 'required|max:1000'
        ]);

        Post::create([
            'content' => request('content'),
            'user_id' => $user_id,
        ]);

        return back();
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        return view('dashboard.post-edit', compact('post'));
    }

    public function update(Post $post)
    {
        $post->update(request()->validate(['content' => 'required']));

        return redirect('/home');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/home');
    }

    public function likes(Request $request, Post $post) {
        $post_id = $request['postId'];
        $is_visit = $request['isLike'] === 'true';
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        $liked = Auth::user()->likes()->where('post_id', $post_id)->first();
        if($liked == $is_like){
            $liked->delete();
            return null;
        }
        else{
            $liked = new Like();
        }
        $liked->user_id = Auth::user();
        $liked->post_id = $post->id;
        $liked->save();
        return null;
    }
}
