<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerConfigTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('server_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gadget_name');
            $table->string('name');
            $table->string('password')->nullable();
            $table->string('admin_passowrd')->nullable();
            $table->text('motd')->nullable();
            $table->unsignedTinyInteger('motd_interval')->nullable();
            $table->unsignedTinyInteger('max_players')->nullable();
            $table->boolean('kick_duplicate')->nullable();
            $table->boolean('verify_signatures')->nullable();
            $table->string('headless_clients')->nullable();
            $table->unsignedTinyInteger('vote_mission_players')->nullable();
            $table->float('vote_threshold')->nullable();
            $table->boolean('disable_von')->nullable();
            $table->unsignedTinyInteger('von_codec_quality')->nullable();
            $table->boolean('persistent')->nullable();
            $table->boolean('battle_eye')->nullable();
            $table->integer('max_ping')->nullable();
            $table->integer('max_desync')->nullable();
            $table->unsignedTinyInteger('max_packetloss')->nullable();
            $table->integer('disconnect_timeout')->nullable();
            $table->boolean('kick_clients_on_slow_network')->nullable();
            $table->string('double_id_detected')->nullable();
            $table->string('on_user_connected')->nullable();
            $table->string('on_user_disconnected')->nullable();
            $table->string('on_hacked_data')->nullable();
            $table->string('on_different_data')->nullable();
            $table->string('on_unsigned_data')->nullable();
            $table->string('regular_check')->nullable();
            $table->string('mission')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('server_config');
    }
}
