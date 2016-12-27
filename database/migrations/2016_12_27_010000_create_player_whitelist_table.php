<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerWhitelistTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('player_whitelist', function (Blueprint $table) {
            $table->integer('player_id')->unsigned();
            $table->integer('whitelist_id')->unsigned();
        });

        Schema::table('player_whitelist', function (Blueprint $table) {
            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('whitelist_id')->references('id')->on('whitelists');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('player_whitelist');
    }
}
