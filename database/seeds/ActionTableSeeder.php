<?php

use Illuminate\Database\Seeder;

class ActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actions')->insert([
            'id' => 1,
            'name' => 'Vehicle Destroyed',
            'color' => '#f2dede'
        ]);
        DB::table('actions')->insert([
            'id' => 3,
            'name' => 'Spieler gestorben',
            'color' => '#ff0000'
        ]);
        DB::table('actions')->insert([
            'id' => 10,
            'name' => 'Missions Start',
            'color' => '#c4e3f3'
        ]);
        DB::table('actions')->insert([
            'id' => 11,
            'name' => 'Mission Lost',
            'color' => '#ff0000'
        ]);
    }
}
