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

use App\User;

Route::get('/', function () {
    return view('welcome')->render();
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

Route::post('/servermanager/addServer', ['uses' => 'Server\ServerManagerController@addServer', 'as' => 'addserver.form'])
    ->middleware('checkrole:admin');

Route::post('/servermanager/delGroup', ['uses' => 'Server\ServerManagerController@delServer', 'as' => 'delserver.form'])
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

// Cheeky Web Terminal

Route::get('/run', function () {

});