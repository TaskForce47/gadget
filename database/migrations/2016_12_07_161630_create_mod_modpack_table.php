<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModModpackTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mod_modpack', function (Blueprint $table) {
            $table->integer('modpack_id')->unsigned();
            $table->integer('mod_id')->unsigned();
        });

        Schema::table('mod_modpack', function (Blueprint $table) {
            $table->foreign('modpack_id')->references('id')->on('modpacks');
            $table->foreign('mod_id')->references('id')->on('mods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('mod_modpack');
    }
}
