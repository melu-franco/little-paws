<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('avatar');
            $table->timestamps();
        });

        DB::table('pet_types')->insert([
            ['id' => '1', 'title' => 'Perro', 'avatar' => 'dog.png'],
            ['id' => '2', 'title' => 'Gato', 'avatar' => 'cat.png'],
            ['id' => '3', 'title' => 'Conejo', 'avatar' => 'rabbit.png'],
            ['id' => '4', 'title' => 'Pájaro', 'avatar' => 'bird.png'],
            ['id' => '5', 'title' => 'Reptil', 'avatar' => 'reptile.png'],
            ['id' => '6', 'title' => 'Roedor', 'avatar' => 'rodent.png'],
            ['id' => '7', 'title' => 'Otro', 'avatar' => 'other.png']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pet_types');
    }
}
