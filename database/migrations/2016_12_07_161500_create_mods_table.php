<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('size');
            $table->string('hash');
            $table->string('workshop_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('mods');
    }
}
