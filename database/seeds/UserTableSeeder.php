<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'password' => Hash::make('admin'),
            'created_at' => Carbon::now()
        ]);

        DB::table('roles')->insert([
            'name' => 'admin',
            'created_at' => Carbon::now()
        ]);

        DB::table('user_has_roles')->insert([
            'role_id' => 1,
            'user_id' => 1
        ]);
    }
}
