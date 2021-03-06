<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class PetType extends Model
{
    protected $table = 'pet_types';

    public function pets(){
        return $this->hasMany(Pet::class);
    }
}
