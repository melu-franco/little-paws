<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Image;
use File;

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


    public function update_avatar(User $user, Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasfile('avatar')){
            $avatar = $request->file('avatar');
            $filename  = public_path('uploads/avatars/').$user->avatar;
            if(File::exists($filename) && $user->avatar != 'user.png') {
                $filename_new = 'user_'. $user->id .'_'. time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(90, 90)->save(public_path('uploads/avatars/' . $filename_new));

                $user->update(['avatar' => $filename_new]);
                File::delete($filename);
            } else {
                $filename_new = 'user_'. $user->id .'_'. time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(90, 90)->save(public_path('uploads/avatars/' . $filename_new));

                $user->update(['avatar' => $filename_new]);
            }
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

        return redirect('/register');
    }
}
