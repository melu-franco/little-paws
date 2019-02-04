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

Route::get('/', 'PagesController@index');
Route::get('/faq', 'PagesController@faq');

Route::get('/home', 'PostsController@index')->name('posts');
Route::post('/posts', 'PostsController@store')->name('post.store');
Route::get('/posts/{post}/edit', 'PostsController@edit');
Route::patch('/posts/{post}', 'PostsController@update');
Route::patch('/posts/{post}/update_image', 'PostsController@update_image');
Route::delete('/posts/{post}/delete_image', 'PostsController@delete_image');
Route::delete('/posts/{post}', 'PostsController@destroy');
Route::post('/posts/likes', 'PostController@likes')->name('like');

Route::get('/profile/{user}', 'UserController@show');
Route::get('/profile/{user}/edit', 'UserController@edit');
Route::patch('/profile/{user}', 'UserController@update')->name('profile');
Route::patch('/profile/{user}/update_avatar', 'UserController@update_avatar')->name('profile-edit');
Route::delete('/profile/{user}/delete_avatar', 'UserController@delete_avatar');
Route::delete('/profile/{user}', 'UserController@destroy');

Route::post('/comment/store', 'CommentController@store')->name('comment.add');
Route::delete('/comment/{comment}', 'CommentController@destroy')->name('comment.delete');

Route::get('/search', 'SearchController@index');


Auth::routes();

Route::get('/', 'PagesController@index');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
