<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->string('player_id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('name');
            $table->integer('team_id')->unsigned()->nullable();
            $table->string('be_guid')->nullable();
            $table->string('remark')->nullable();
            $table->string('email')->nullable();
            $table->string('icq')->nullable();
            $table->string('steam')->nullable();
            $table->string('skype')->nullable();
            $table->string('country');
        });

        Schema::table('players', function (Blueprint $table) {
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('players');
    }
}
