<?php

use Illuminate\Database\Seeder;

class WhitelistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('whitelists')->insert([
            'id' => 1,
            'name' => 'Luftfahrzeugwhitelist'
        ]);
        DB::table('whitelists')->insert([
            'id' => 2,
            'name' => 'Panzerwhitelist'
        ]);
        DB::table('whitelists')->insert([
            'id' => 3,
            'name' => 'CCT Whitelist'
        ]);
    }
}
