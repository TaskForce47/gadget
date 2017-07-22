<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mission_id')->unsigned();
            $table->string('name')->nullable8();
            $table->passthru('boolean', 'active', 'bit(1)')->nullable()->default(DB::Raw(0));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('missions');
    }
}
