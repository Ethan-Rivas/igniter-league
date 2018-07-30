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

Route::get('/tournaments', 'TournamentController@index')->name('tournaments');
Route::get('/tournaments/new', 'TournamentController@create')->name('tournaments.new');
Route::post('/tournaments/new', 'TournamentController@store');

Auth::routes();
