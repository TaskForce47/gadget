<?php

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
        ]);

        DB::table('roles')->insert([
            'name' => 'admin'
        ]);

        DB::table('user_has_roles')->insert([
            'role_id' => 1,
            'user_id' => 1
        ]);
    }
}
