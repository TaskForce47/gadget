<?php

use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'id' => 1,
            'tag' => '[TF47 Stammspieler]',
            'name' => '[TF47] Task Force 47 - Die ArmA 3 ACE-Community',
            'web' => 'http://task-force47.de/',
            'email' => 'admin@task-force47.de',
            'title' => 'TF47 Stammspieler',
            'directory' => 'stammspieler'
        ]);

    }
}
