<?php

use Illuminate\Foundation\Inspiring;
use App\Http\Models\Role;
use App\Http\Models\Permission;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('setup', function () {
    $user = \App\Http\Models\User::findOrFail(1);

    $role = Role::create(['name' => 'admin']);
    $user->assignRole($role);
    $role->syncPermissions(\App\Http\Models\Permission::all());

    $permissions = ['admin','ticketLog','ticketLogManager','playerManager','commentManager',
        'teamManager','whitelistManager','xmlManager','whitelist_1','whitelist_2','whitelist_3',
        'team_1'];

    foreach ($permissions as $permission) {
        Permission::create(['name' => $permission]);
        $role->givePermissionTo($permission);
    }
})->describe('Creates various roles and permissions');