<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModpackTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('modpack', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('mod_id')->references('id')->on('mod');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('modpack');
    }
}
