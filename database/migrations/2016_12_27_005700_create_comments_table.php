<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player_id')->unsigned();
            $table->integer('whitelist_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->timestamp('created_at');
            $table->text('comment');
            $table->unsignedInteger('deleter_id')->nullable();
            $table->passthru('boolean', 'warning', 'bit(1)')->default(DB::Raw(0));
            $table->passthru('boolean', 'deleted', 'bit(1)')->default(DB::Raw(0));
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('whitelist_id')->references('id')->on('whitelists');
            $table->foreign('author_id')->references('id')->on('players');
            $table->foreign('deleter_id')->references('id')->on('players');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
