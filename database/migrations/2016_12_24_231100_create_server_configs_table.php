<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerConfigsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('server_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gadget_name');
            $table->string('name');
            $table->string('password')->nullable();
            $table->string('admin_password')->nullable();
            $table->passthru('string', 'motd', 'text')->nullable();
            $table->integer('motd_interval')->nullable()->default(3);
            $table->integer('max_players')->nullable()->default(1);
            $table->passthru('boolean', 'kick_duplicates', 'bit(1)')->nullable()->default(DB::Raw(1));
            $table->passthru('boolean', 'verify_signatures', 'bit(1)')->nullable()->default(DB::Raw(1));
            $table->string('headless_clients')->nullable();
            $table->integer('vote_mission_players')->nullable()->default(1);
            $table->passthru('float', 'vote_threshold', 'float')->nullable()->default(1);
            $table->passthru('boolean', 'disable_von', 'bit(1)')->nullable()->default(DB::Raw(1));
            $table->integer('von_codec_quality')->nullable()->default(10);
            $table->passthru('boolean', 'persistent', 'bit(1)')->nullable()->default(DB::Raw(0));
            $table->passthru('boolean', 'battle_eye', 'bit(1)')->nullable()->default(DB::Raw(1));
            $table->integer('max_ping')->nullable()->default(1000);
            $table->integer('max_desync')->nullable()->default(10000);
            $table->integer('max_packetloss')->nullable()->default(10000);
            $table->integer('disconnect_timeout')->nullable()->default(90);
            $table->passthru('boolean', 'kick_clients_on_slow_network', 'bit(1)')->nullable()->default(DB::Raw(0));
            $table->string('double_id_detected')->nullable();
            $table->string('on_user_connected')->nullable();
            $table->string('on_user_disconnected')->nullable();
            $table->string('on_hacked_data')->nullable();
            $table->string('on_different_data')->nullable();
            $table->string('on_unsigned_data')->nullable();
            $table->string('regular_check')->nullable();
            $table->string('mission')->nullable();
            $table->unsignedInteger('modpack_id')->nullable();
            $table->string('difficulty')->nullable();
        });

        Schema::table('server_configs', function (Blueprint $table) {
            $table->foreign('modpack_id')->references('id')->on('modpacks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('server_configs');
    }
}
