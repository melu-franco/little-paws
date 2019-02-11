<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pets';

    protected $fillable = [
        'name', 'description', 'avatar', 'pet_type_id', 'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pet_type(){
        return $this->belongsTo(PetType::class, 'pet_type_id', 'id', 'title', 'avatar');
    }

}
