<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\User;
use App\Pet;

class FeedController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user, Comment $comment)
    {
        $ids = auth()->user()->following()->pluck("followed_id")->toArray();
        $posts_following = Post::whereIn('user_id', $ids)
                     ->latest()->take(20)->get();
        $posts = Post::latest()->take(20)->get();

        $pets = Pet::where('user_id', auth()->user()->id)->get();

        return view('dashboard.index', compact('posts','posts_following','user','comment','pets'));
    }

}
