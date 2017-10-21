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

Route::get('/threads/{thread}','ThreadsController@show');
Route::post('/threads','ThreadsController@store');

Route::post('/threads/{thread}/replies','ReplyController@store')->name("add_reply_to_thread");
Route::get('/threads','ThreadsController@index')->name("threads");
Route::get('/user/{user}','UserController@show');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
