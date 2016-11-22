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

Route::get('/usermanager', 'Admin\UsermanagerController@index');

Route::get('/usermanager/getUsers', 'Admin\UsermanagerController@getUsers');

Route::get('/usermanager/edit/{id}', 'Admin\UsermanagerController@edit');

Route::get('/run', function () {
});