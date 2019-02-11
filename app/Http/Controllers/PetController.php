<?php

namespace App\Http\Controllers;

use App\Pet;
use App\PetType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;


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
            'description' => ['max:1000'],
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
            Image::make($avatar)
                    ->resize(90, 90)
                    ->save(public_path('uploads/avatars/pets/' . $avatarName));

            $pet->update(['avatar' => $avatarName]);
        }

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit(Pet $pet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        //
    }
}
