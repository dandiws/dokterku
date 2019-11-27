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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/test', function ()
{
    return view('welcome');
});

Route::get('doctors','HomeController@search')->name('doctor.search');

Route::get('chat-users', 'ChatsController@users')->name('chat.users');
Route::get('chats', 'ChatsController@index')->name('chat.index');
Route::get('chats/{friend}', 'ChatsController@friend')->name('chat.friend');
Route::get('messages/{friend}', 'ChatsController@fetchMessages')->name('messages.friend');
Route::post('messages', 'ChatsController@sendMessage');
