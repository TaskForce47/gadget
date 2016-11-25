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


// Cheeky Web Terminal

Route::get('/run', function () {

});