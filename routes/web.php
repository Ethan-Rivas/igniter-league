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

Route::get('/', 'HomeController@index')->name('home');

// Tournaments
Route::get('/tournaments', 'TournamentController@index')->name('tournaments');
Route::get('/tournaments/new', 'TournamentController@create')->name('tournaments.new');
Route::post('/tournaments/new', 'TournamentController@store');

// Providers
Route::get('/providers/new', 'ProviderController@create')->name('providers.new');
Route::post('/providers/new', 'ProviderController@store');

// Users
Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');
Route::put('/users/{id}/edit', 'UserController@update');

 Admin
//Route::prefix('admin')->group(['middleware' => 'is.admin'], function () {
//    Route::get()
//});

Auth::routes();
