<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class UserController extends Controller
{

    public function show(User $user, Post $post)
    {
        return view('dashboard.profile', compact('user'));
    }

    public function edit(User $user)
    {
        return view('dashboard.profile-edit', compact('user'));
    }

    public function update(User $user)
    {
        $user->update(request()->validate([
            'name' => 'required',
            'description' => 'max:500',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]));

        return redirect()->route('profile', [$user]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/register');
    }
}
