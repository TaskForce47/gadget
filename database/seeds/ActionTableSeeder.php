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
            'name' => 'Fahrzeug zerstört',
            'color' => '#fff5f5'
        ]);
        DB::table('actions')->insert([
            'id' => 2,
            'name' => 'Fahrzeug verschwunden',
            'color' => '#ffecec'
        ]);
        DB::table('actions')->insert([
            'id' => 3,
            'name' => 'Spieler gestorben',
            'color' => '#f9eeff'
        ]);
        DB::table('actions')->insert([
            'id' => 4,
            'name' => 'Ziviler Verlust',
            'color' => '#e9e9e9'
        ]);
        DB::table('actions')->insert([
            'id' => 5,
            'name' => 'Ziel erfüllt',
            'color' => '#e3fbe9'
        ]);
        DB::table('actions')->insert([
            'id' => 6,
            'name' => 'Ziel nicht erfüllt',
            'color' => '#d95a5a'
        ]);
        DB::table('actions')->insert([
            'id' => 7,
            'name' => 'Info',
            'color' => '#e9e9e9'
        ]);
        DB::table('actions')->insert([
            'id' => 8,
            'name' => 'Ticket Manipulation durch Admin',
            'color' => '#dbcea0'
        ]);
        DB::table('actions')->insert([
            'id' => 9,
            'name' => 'Ticket Reset durch Admin',
            'color' => '#dbcea0'
        ]);
        DB::table('actions')->insert([
            'id' => 10,
            'name' => 'Missions Start',
            'color' => '#e9e9e9'
        ]);
        DB::table('actions')->insert([
            'id' => 11,
            'name' => 'Mission abgeschlossen',
            'color' => '#e3fbe9'
        ]);
        DB::table('actions')->insert([
            'id' => 12,
            'name' => 'Mission verloren',
            'color' => '#d95a5a'
        ]);
    }
}
