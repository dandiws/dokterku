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

//kego
Route::get('threads', 'ThreadsController@index');
Route::get('threads/create', 'ThreadsController@create');
Route::get('threads/{channel}/{thread}', 'ThreadsController@show');
Route::post('threads', 'ThreadsController@store');
Route::get('threads/{channel}', 'ThreadsController@index');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');
Route::get('channels', 'ChannelsController@index');
Route::get('channels/create', 'ChannelsController@create');
Route::post('channels', 'ChannelsController@store');


//dandi
Route::get('doctors','HomeController@search')->name('doctor.search');

Route::get('chat-users', 'ChatsController@users')->name('chat.users');
Route::get('chats', 'ChatsController@index')->name('chat.index');
Route::get('chats/{friend}', 'ChatsController@friend')->name('chat.friend');
Route::get('messages/{friend}', 'ChatsController@fetchMessages')->name('messages.friend');
Route::post('messages', 'ChatsController@sendMessage');
