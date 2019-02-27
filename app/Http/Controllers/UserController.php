<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Pet;
use App\Like;
use Image;
use File;
use DB;

class UserController extends Controller
{

    public function show()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('dashboard.users', compact('users'));
    }

    public function profile(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->take(20)->get();
        $pets = Pet::where('user_id', auth()->user()->id)->get();
        $pet_types = DB::table('pet_types')->get();

        return view('dashboard.profile', compact('user','posts','pets','pet_types'));
    }

    public function edit(User $user)
    {
        return view('dashboard.profile-edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $user->update(request()->validate([
            'name' => 'required',
            'description' => 'max:500',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]));

        if($request->hasfile('avatar')){
            $avatar = $request->file('avatar');
            $filename  = public_path('uploads/avatars/').$user->avatar;
            $filename_new = 'user_'. $user->id .'_'. time() . '.' . $avatar->getClientOriginalExtension();

            Image::make($avatar->getRealPath())
            ->resize(180, 180,function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path('uploads/avatars/' . $filename_new));

            if(File::exists($filename) && $user->avatar != 'user.png') {
                File::delete($filename);
            }

            $user->update(['avatar' => $filename_new]);
        }

        return redirect()->route('profile', [$user]);
    }

    public function update_description(User $user)
    {
        $user->update(request()->validate([
            'description' => 'max:500',
        ]));

        return back();
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

            Image::make($avatar->getRealPath())
            ->resize(180, 180,function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path('uploads/avatars/' . $filename_new));

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

    public function update_cover(User $user, Request $request)
    {
        $request->validate([
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasfile('cover')){
            $cover = $request->file('cover');
            $filename  = public_path('uploads/covers/').$user->cover;
            $filename_new = 'cover_'. $user->id .'_'. time() . '.' . $cover->getClientOriginalExtension();
            Image::make($cover)->save(public_path('uploads/covers/' . $filename_new));

            if(File::exists($filename) && $user->cover != '') {
                File::delete($filename);
            }

            $user->update(['cover' => $filename_new]);
        }

        return back();
    }

    public function delete_cover(User $user){
        $cover  = public_path('uploads/covers/').$user->cover;

        if(File::exists($cover) && $user->cover != '' ) {
            File::delete($cover);
            $user->update(['cover' => '']);
        }

        return back();
    }

    // Follow user.
    public function follow_user(User $user)
    {
        if(! $user) {
            return redirect()->back()->with('error', 'Usuario inexistente.');
        }

        $user->followers()->attach(auth()->user()->id);
        return redirect()->back();
    }

    public function unfollow_user(User $user)
    {
        if(! $user) {
            return redirect()->back()->with('error', 'Usuario inexistente.');
        }
        $user->followers()->detach(auth()->user()->id);
        return redirect()->back();
    }

    public function destroy(User $user)
    {
        $user->delete();
        $avatar  = public_path('uploads/avatars/').$user->avatar;

        if (File::exists($avatar) && $user->avatar != 'user.png' ) {
            File::delete($avatar);
        }

        Post::where('user_id', $user->id)->delete();
        Like::where('user_id', $user->id)->delete();

        return redirect('/register');
    }
}
