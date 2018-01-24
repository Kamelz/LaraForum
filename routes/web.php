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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/threads/create','ThreadsController@create')->name('create.thread');
Route::get('/profile/{user}','ProfileController@show')->name("profile");

Route::get('/threads/{channel}/{thread}','ThreadsController@show');
Route::delete('/threads/{channel}/{thread}','ThreadsController@destroy');

Route::post('/threads','ThreadsController@store');

Route::post('/threads/{channel}/{thread}/replies','ReplyController@store')->name("add_reply_to_thread");
Route::get('/threads/{channel}','ThreadsController@index');
Route::get('/threads','ThreadsController@index')->name("threads");
Route::get('/user/{user}','UserController@show');
Route::post('/replies/{reply}/favorites','FavoriteController@store');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
