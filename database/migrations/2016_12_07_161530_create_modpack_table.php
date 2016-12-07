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
            $table->string('name');
            $table->string('repository');
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
