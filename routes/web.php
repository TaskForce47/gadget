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

Auth::routes();

Route::get('/', 'DashboardController@index');

// XML

Route::get('/xml/generate', 'Player\XMLController@generate')->middleware('checkrole:admin');

// Usermanager

Route::get('/users', 'Admin\UserManagerController@index')->middleware('checkrole:admin');

Route::get('/users/edit/{id}', 'Admin\UserManagerController@edit')->middleware('checkrole:admin');

Route::post('/users/saveEdit', ['uses' => 'Admin\UserManagerController@saveEdit', 'as' => 'editUser.form'])
    ->middleware('checkrole:admin');

// Group/Rolemanager

Route::get('/groups', 'Admin\GroupManagerController@index')->middleware('checkrole:admin');

Route::get('/groups/{id}/edit', 'Admin\GroupManagerController@edit')->middleware('checkrole:admin');

Route::get('/groups/{id}/delete', 'Admin\GroupManagerController@delete')->middleware('checkrole:admin');

Route::post('/groups/saveEdit', ['uses' => 'Admin\GroupManagerController@saveEdit', 'as' => 'editGroup.form'])
    ->middleware('checkrole:admin');



// ServerManager

Route::get('/servermanager', 'Server\ServerManagerController@index')->middleware('checkrole:admin');

Route::get('/servermanager/edit/{id}', 'Server\ServerManagerController@edit')->middleware('checkrole:admin');

Route::get('/servermanager/delete/{id}', 'Server\ServerManagerController@delete')->middleware('checkrole:admin');


// Whitelists

Route::get('/whitelists', 'Player\WhitelistManagerController@index')->middleware('checkrole:admin');

Route::get('/whitelists/edit/{id}', 'Player\WhitelistManagerController@edit')->middleware('checkrole:admin');

Route::post('/whitelists/saveEdit', ['uses' => 'Player\WhitelistManagerController@saveEdit', 'as' => 'editwhitelist.form'])
    ->middleware('checkrole:admin');

Route::get('whitelists/{id}/delete', 'Player\WhitelistManagerController@delete')->middleware('checkrole:admin');

// Players

Route::get('/players', 'Player\PlayerManagerController@index')->middleware('checkrole:admin');

Route::get('/players/{id}/edit', 'Player\PlayerManagerController@edit')->middleware('checkrole:admin');

Route::get('players/{id}/delete', 'Player\PlayerManagerController@delete')->middleware('checkrole:admin');

Route::post('/players/saveEdit', ['uses' => 'Player\PlayerManagerController@saveEdit', 'as' => 'editPlayer.form'])
    ->middleware('checkrole:admin');

// Comments

Route::get('comments', 'Player\CommentManagerController@indexAll')->middleware('checkrole:admin');

Route::get('players/{id}/comments', 'Player\CommentManagerController@index')->middleware('checkrole:admin');

Route::get('/players/{id}/comments/{commentId}/edit', 'Player\CommentManagerController@edit')
    ->middleware('checkrole:admin');

Route::get('/players/{id}/comments/{commentId}/delete/{showAll}', 'Player\CommentManagerController@delete')
    ->middleware('checkrole:admin');

Route::get('/players/{id}/comments/{commentId}/recover/{showAll}', 'Player\CommentManagerController@recover')
    ->middleware('checkrole:admin');

Route::post('/players/comments/saveComment', ['uses' => 'Player\CommentManagerController@saveEdit',
    'as' => 'saveComment.form'])->middleware('checkrole:admin');


// Teams

Route::get('/teams', 'Player\TeamManagerController@index')->middleware('checkrole:admin');

Route::get('/teams/{id}/edit', 'Player\TeamManagerController@edit')->middleware('checkrole:admin');

Route::post('/teams/saveEdit', ['uses' => 'Player\TeamManagerController@saveEdit', 'as' => 'editTeam.form'])
    ->middleware('checkrole:admin');

Route::get('teams/{id}/delete', 'Player\TeamManagerController@delete')->middleware('checkrole:admin');

// Ticetlog

Route::get('/missions/ticketlog/{id}', 'Mission\MissionController@index')->middleware('checkrole:admin');

Route::get('missions/ticketlog/{id}/old', 'Mission\MissionController@old')->middleware('checkrole:admin');

// Cheeky Web Terminal

Route::get('/run', function () {

    /*
    $user = Auth::user();
    $role = Role::create(['name' => 'admin']);
    $user->assignRole('admin');
    */
});