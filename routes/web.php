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

Route::get('/usermanager', function () {

    if(Auth::check() && Auth::user()->hasRole('admin')) {
        $users = DB::table('users')->paginate();
        $stuff = DB::select('SELECT us.name as username, ro.name as rolename FROM users AS us, user_has_roles AS r, roles AS ro WHERE r.user_id=us.id AND r.role_id=ro.id;');

        var_dump($stuff[0]);
        var_dump($stuff[1]);
        return view('admin.usermanager', ['users' => $users,'stuffs' => $stuff])->render();
    } else {
        return redirect()->back();
    }
});

Route::get('/run', function () {

});