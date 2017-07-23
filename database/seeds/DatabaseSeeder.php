<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ActionTableSeeder::class);
        $this->call(WhitelistTableSeeder::class);
        $this->call(TeamTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
