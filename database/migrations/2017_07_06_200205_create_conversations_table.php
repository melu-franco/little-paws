<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('subject');
            $table->integer('id_from');
            $table->integer('id_to');
            $table->timestamps();
        });

        Schema::table('conversations', function (Blueprint $table)
        {
            $table->foreign('id_from')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_to')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversations');
    }
}
