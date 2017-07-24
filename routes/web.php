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

Route::post('changePasssword', ['uses' => 'Auth\ChangePasswordController@changePassword', 'as' => 'changePassword.form']);

Route::get('/', 'DashboardController@index');

// XML

Route::get('/xml/generate', 'Player\XMLController@generate')->middleware('checkPermission:xmlManager');

// Usermanager

Route::get('/users', 'Admin\UserManagerController@index')->middleware('checkPermission:admin');

Route::get('/users/edit/{id}', 'Admin\UserManagerController@edit')->middleware('checkPermission:admin');

Route::post('/users/saveEdit', ['uses' => 'Admin\UserManagerController@saveEdit', 'as' => 'editUser.form'])
    ->middleware('checkPermission:admin');

// Group/Rolemanager

Route::get('/groups', 'Admin\GroupManagerController@index')->middleware('checkPermission:admin');

Route::get('/groups/{id}/edit', 'Admin\GroupManagerController@edit')->middleware('checkPermission:admin');

Route::get('/groups/{id}/delete', 'Admin\GroupManagerController@delete')->middleware('checkPermission:admin');

Route::post('/groups/saveEdit', ['uses' => 'Admin\GroupManagerController@saveEdit', 'as' => 'editGroup.form'])
    ->middleware('checkPermission:admin');



// ServerManager

Route::get('/servermanager', 'Server\ServerManagerController@index')->middleware('checkPermission:admin');

Route::get('/servermanager/edit/{id}', 'Server\ServerManagerController@edit')->middleware('checkPermission:admin');

Route::get('/servermanager/delete/{id}', 'Server\ServerManagerController@delete')->middleware('checkPermission:admin');

Route::post('/servermanager/saveEdit', ['uses' => 'Server\ServerManagerController@saveEdit', 'as' => 'editServer.form'])
    ->middleware('checkPermission:admin');

// Whitelists

Route::get('/whitelists', 'Player\WhitelistManagerController@index')->middleware('checkPermission:whitelistManager');

Route::get('/whitelists/{id}/edit', 'Player\WhitelistManagerController@edit')->middleware('checkPermission:whitelistManager');

Route::post('/whitelists/saveEdit', ['uses' => 'Player\WhitelistManagerController@saveEdit', 'as' => 'editwhitelist.form'])
    ->middleware('checkPermission:whitelistManager');

Route::get('whitelists/{id}/delete', 'Player\WhitelistManagerController@delete')->middleware('checkPermission:whitelistManager');

// Players

Route::get('/players', 'Player\PlayerManagerController@index')->middleware('checkPermission:playerManager');

Route::get('/players/{id}/edit', 'Player\PlayerManagerController@edit')->middleware('checkPermission:playerManager');

Route::get('players/{id}/delete', 'Player\PlayerManagerController@delete')->middleware('checkPermission:playerManager');

Route::post('/players/saveEdit', ['uses' => 'Player\PlayerManagerController@saveEdit', 'as' => 'editPlayer.form'])
    ->middleware('checkPermission:playerManager');

// Comments

Route::get('comments', 'Player\CommentManagerController@indexAll')->middleware('checkPermission:commentManager');

Route::get('players/{id}/comments', 'Player\CommentManagerController@index')->middleware('checkPermission:commentManager');

Route::get('/players/{id}/comments/{commentId}/edit', 'Player\CommentManagerController@edit')
    ->middleware('checkPermission:commentManager');

Route::get('/players/{id}/comments/{commentId}/delete/{showAll}', 'Player\CommentManagerController@delete')
    ->middleware('checkPermission:commentManager');

Route::get('/players/{id}/comments/{commentId}/recover/{showAll}', 'Player\CommentManagerController@recover')
    ->middleware('checkPermission:commentManager');

Route::post('/players/comments/saveComment', ['uses' => 'Player\CommentManagerController@saveEdit',
    'as' => 'saveComment.form'])->middleware('checkPermission:commentManager');


// Teams

Route::get('/teams', 'Player\TeamManagerController@index')->middleware('checkPermission:teamManager');

Route::get('/teams/{id}/edit', 'Player\TeamManagerController@edit')->middleware('checkPermission:teamManager');

Route::post('/teams/saveEdit', ['uses' => 'Player\TeamManagerController@saveEdit', 'as' => 'editTeam.form'])
    ->middleware('checkPermission:teamManager');

Route::get('teams/{id}/delete', 'Player\TeamManagerController@delete')->middleware('checkPermission:teamManager');

// TicketLog

Route::get('missions', 'Mission\MissionManagerController@index')->middleware('checkPermission:ticketLogManager');

Route::get('missions/{id}/edit', 'Mission\MissionManagerController@edit')->middleware('checkPermission:ticketLogManager');

Route::post('missions/saveEdit',  ['uses' => 'Mission\MissionManagerController@saveEdit', 'as' => 'editMission.form'])
    ->middleware('checkPermission:ticketLogManager');

Route::get('missions/{id}/delete', 'Mission\MissionManagerController@delete')->middleware('checkPermission:ticketLogManager');


// Cheeky Web Terminal

Route::get('/run', function () {


    /*
    $user = Auth::user();
    $role = Role::create(['name' => 'admin']);
    $user->assignRole('admin');
    */
});