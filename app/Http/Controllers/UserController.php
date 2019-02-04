<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Image;
use File;

class UserController extends Controller
{

    public function show(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->take(20)->get();
        return view('dashboard.profile', compact('user','posts'));
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
        ]));

        return redirect()->route('profile', [$user]);
    }

    public function update_avatar(User $user, Request $request)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasfile('avatar')){
            $avatar = $request->file('avatar');
            $filename  = public_path('uploads/avatars/').$user->avatar;
            $filename_new = 'user_'. $user->id .'_'. time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(90, 90)->save(public_path('uploads/avatars/' . $filename_new));

            if(File::exists($filename) && $user->avatar != 'user.png') {
                File::delete($filename);
            }

            $user->update(['avatar' => $filename_new]);
        }

        return back();
    }

    public function delete_avatar(User $user){
        $avatar  = public_path('uploads/avatars/').$user->avatar;

        if(File::exists($avatar) && $user->avatar != 'user.png' ) {
            File::delete($avatar);
            $old_avatar  = 'user.png';
            $user->update(['avatar' => $old_avatar]);
        }

        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();
        Post::where('user_id', $user->id)->delete();

        return redirect('/register');
    }
}
