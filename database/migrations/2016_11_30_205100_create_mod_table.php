<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mod', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('download_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('mod');
    }
}
