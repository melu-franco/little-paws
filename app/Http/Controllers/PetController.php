<?php

namespace App\Http\Controllers;

use App\Pet;
use App\PetType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
use Image;
use File;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function create()
    {

        $pet_types = DB::table('pet_types')->get();

        return view('dashboard.pet-create', compact('pet_types'));
    }


    public function store(Request $request, Pet $pet)
    {
        $user_id = auth()->user()->id;

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'description' => ['max:500'],
            'pet_type_id' => ['required'],
        ]);

        $pet = Pet::create([
            'user_id' => $user_id,
            'name' => request('name'),
            'description' => request('description'),
            'pet_type_id' => request('pet_type_id'),
        ]);

        if($request->hasfile('avatar')){
            $avatar = $request->file('avatar');
            $avatarName = 'pet_'. $pet->id .'_'. time() . '.' . $avatar->getClientOriginalExtension();
            $image = Image::make($avatar->getRealPath());

            $image->resize(180, 180,function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path('uploads/avatars/pets/' . $avatarName));

            $pet->update(['avatar' => $avatarName]);
        }

        return redirect('/home');
    }

    public function show(User $user, Pet $pet)
    {
        return view('dashboard.pet-profile', compact('user','pet'));
    }

    public function edit(Pet $pet)
    {
        return view('dashboard.pet-profile-edit', compact('pet'));
    }

    public function update(User $user)
    {
        $pet->update(request()->validate([
            'name' => 'required',
            'description' => 'max:500',
        ]));

        return redirect()->route('pet-profile', [$pet]);
    }

    public function update_avatar(Pet $pet, Request $request)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasfile('avatar')){
            $avatar = $request->file('avatar');
            $filename  = public_path('uploads/avatars/pets/').$pet->avatar;
            $filename_new = 'pet_'. $pet->id .'_'. time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(90, 90)->save(public_path('uploads/avatars/pets/' . $filename_new));

            if(File::exists($filename)) {
                File::delete($filename);
            }

            $user->update(['avatar' => $filename_new]);
        }

        return back();
    }

    public function delete_avatar(User $user){
        $avatar  = public_path('uploads/avatars/pets/').$pet->avatar;

        if(File::exists($avatar)) {
            File::delete($avatar);
        }

        return back();
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();
        $avatar  = public_path('uploads/avatars/pets/').$pet->avatar;
        File::delete($avatar);
    }
}
