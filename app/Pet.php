<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'name', 'description', 'avatar', 'pet_type_id', 'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function petType(){
        return DB::table('pets')
                ->leftJoin('pet_types', 'pets.id', '=', 'pet_types.id')
                ->select('pet_types.avatar as avatar', 'pet_types.title as title', 'pets.*')
                ->get();
    }

    
}
