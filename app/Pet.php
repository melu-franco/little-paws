<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pets';

    protected $fillable = [
        'user_id', 'name', 'description', 'pet_type_id', 'avatar'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pet_type(){
        return $this->belongsTo(PetType::class, 'pet_type_id','id');
    }

    public function getAvatarAttribute($value) {
        if($value) {
            return '/uploads/avatars/pets/'.$value;
        } else {
            return '/img/pets_avatars/'.$this->pet_type->avatar;
        }
    }

}
