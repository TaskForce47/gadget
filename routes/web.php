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

Route::get('/usermanager', 'Admin\UsermanagerController@index')->middleware('checkrole:admin');

// 501
Route::get('/usermanager/getUsers', 'Admin\UsermanagerController@getUsers')->middleware('checkrole:admin');

Route::get('/usermanager/edit/{id}', 'Admin\UsermanagerController@edit')->middleware('checkrole:admin');

Route::post('/usermanager/saveEdit', ['uses' => 'Admin\UsermanagerController@saveEdit', 'as' => 'edituser.form'])->middleware('checkrole:admin');


Route::get('/groupmanager', 'Admin\GroupmanagerController@index')->middleware('checkrole:admin');

Route::get('/run', function () {

});