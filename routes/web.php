<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Server;
use App\Http\Controllers\Whitelists;

use App\Http\Models\User;

Route::get('/', function () {
    return view('welcome')->with('currentTreeView', 'dashboard')->with('currentMenuView', 'home')->render();
});

Auth::routes();

Route::get('/home', 'HomeController@index');


// Usermanager

Route::get('/usermanager', 'Admin\UsermanagerController@index')->middleware('checkrole:admin');

Route::get('/usermanager/edit/{id}', 'Admin\UsermanagerController@edit')->middleware('checkrole:admin');

Route::post('/usermanager/saveEdit', ['uses' => 'Admin\UsermanagerController@saveEdit', 'as' => 'edituser.form'])
    ->middleware('checkrole:admin');

// Group/Rolemanager

Route::get('/groupmanager', 'Admin\GroupmanagerController@index')->middleware('checkrole:admin');

Route::get('/groupmanager/edit/{id}', 'Admin\GroupmanagerController@edit')->middleware('checkrole:admin');

Route::post('/groupmanager/saveEdit', ['uses' => 'Admin\GroupmanagerController@saveEdit', 'as' => 'editgroup.form'])
    ->middleware('checkrole:admin');

Route::post('/groupmanager/addGroup', ['uses' => 'Admin\GroupmanagerController@addGroup', 'as' => 'addgroup.form'])
    ->middleware('checkrole:admin');

Route::post('/groupmanager/delGroup', ['uses' => 'Admin\GroupmanagerController@delGroup', 'as' => 'delgroup.form'])
    ->middleware('checkrole:admin');

// ServerManager

Route::get('/servermanager', 'Server\ServerManagerController@index')->middleware('checkrole:admin');

Route::get('/servermanager/edit/{id}', 'Server\ServerManagerController@edit')->middleware('checkrole:admin');

Route::post('/groupmanager/saveEdit', ['uses' => 'Server\ServerManagerController@saveEdit', 'as' => 'editServer.form'])
    ->middleware('checkrole:admin');

Route::post('/servermanager/addServer', ['uses' => 'Server\ServerManagerController@addServer', 'as' => 'addserver.form'])
    ->middleware('checkrole:admin');

Route::post('/servermanager/delServer', ['uses' => 'Server\ServerManagerController@delServer', 'as' => 'delServer.form'])
    ->middleware('checkrole:admin');

// Whitelists

Route::get('/whitelists', 'Whitelists\WhitelistManagerController@index')->middleware('checkrole:admin');

Route::get('/whitelists/edit/{id}', 'Whitelists\WhitelistManagerController@edit')->middleware('checkrole:admin');

Route::post('/whitelists/saveEdit', ['uses' => 'Whitelists\WhitelistManagerController@saveEdit', 'as' => 'editwhitelist.form'])
    ->middleware('checkrole:admin');

Route::post('/whitelists/add', ['uses' => 'Whitelists\WhitelistManagerController@add', 'as' => 'addwhitelist.form'])
    ->middleware('checkrole:admin');

Route::post('/whitelists/del', ['uses' => 'Whitelists\WhitelistManagerController@del', 'as' => 'delwhitelist.form'])
    ->middleware('checkrole:admin');

// Players

Route::get('/players', 'Player\PlayerManagerController@index')->middleware('checkrole:admin');

Route::get('/players/edit/{id}', 'Player\PlayerManagerController@edit')->middleware('checkrole:admin');

Route::get('/players/edit/', 'Player\PlayerManagerController@addNew')->middleware('checkrole:admin');

Route::post('/players/saveEdit', ['uses' => 'Player\PlayerManagerController@saveEdit', 'as' => 'editPlayer.form'])
    ->middleware('checkrole:admin');

Route::post('/players/add', ['uses' => 'Player\PlayerManagerController@add', 'as' => 'addPlayer.form'])
    ->middleware('checkrole:admin');

Route::post('/players/del', ['uses' => 'Player\PlayerManagerController@del', 'as' => 'delPlayer.form'])
    ->middleware('checkrole:admin');


// Teams

Route::get('/teams', 'Player\TeamManagerController@index')->middleware('checkrole:admin');

Route::get('/teams/edit/{id}', 'Player\TeamManagerController@edit')->middleware('checkrole:admin');

Route::get('/teams/edit/', 'Player\TamManagerController@addNew')->middleware('checkrole:admin');

Route::post('/teams/saveEdit', ['uses' => 'Player\TeamManagerController@saveEdit', 'as' => 'editTeam.form'])
    ->middleware('checkrole:admin');

Route::post('/teams/add', ['uses' => 'Player\TeamManagerController@add', 'as' => 'addTeam.form'])
    ->middleware('checkrole:admin');

Route::post('/teams/del', ['uses' => 'Player\TeamManagerController@del', 'as' => 'delTeam.form'])
    ->middleware('checkrole:admin');

// Cheeky Web Terminal

Route::get('/run', function () {

    /*
    $user = Auth::user();
    $role = Role::create(['name' => 'admin']);
    $user->assignRole('admin');
    */
});