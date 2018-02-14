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
//demo acl 1
//Route::resource('posts','PermissionsDemo\PostsController');
Route::get('posts/{id}','PermissionsDemo\PostsController@show');
Route::get('send_mail','EmailDemo\TestEmailController@send');
Route::any('smail_markdown','EmailDemo\TestEmailController@smail_markdown');