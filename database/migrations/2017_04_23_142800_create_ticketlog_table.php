<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketlogTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ticketlog', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mission_id')->unsigned();
            $table->timestamp('timestamp');
            $table->integer('action_id')->unsigned();
            $table->integer('change');
            $table->integer('tickets');
            $table->integer('round')->unsigned();
            $table->integer('player_id')->unsigned()->nullable();
        });

        Schema::table('ticketlog', function (Blueprint $table) {
            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('action_id')->references('id')->on('actions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('ticketlog');
    }
}
