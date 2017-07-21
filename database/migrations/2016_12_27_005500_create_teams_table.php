<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tag');
            $table->string('name');
            $table->string('email');
            $table->string('web');
            $table->string('title');
            $table->string('directory');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('teams');
    }
}
