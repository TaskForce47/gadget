<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModpacksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('modpacks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('modpacks');
    }
}
