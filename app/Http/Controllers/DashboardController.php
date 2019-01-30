<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->take(20)->get();
        return view('dashboard.index', compact('posts'));
    }

}
