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

Route::get('/home', 'PostsController@index');
Route::post('/home', 'PostsController@store');
Route::get('/posts/{post}/edit', 'PostsController@edit');
Route::patch('/posts/{post}', 'PostsController@update');
Route::delete('/posts/{post}', 'PostsController@destroy');
Route::post('/like', 'PostController@likes')->name('like');

/* Route::post('/profile', 'PostsController@store');
 */
Route::get('/profile/{user}', 'UserController@show');
Route::get('/profile/{user}/edit', 'UserController@edit');
Route::patch('/profile/{user}', 'UserController@update');
Route::delete('/profile/{user}', 'UserController@destroy');

Route::get('/search', 'SearchController@index');

/* Route::resource('dashboard', 'PostsController');
 */
Auth::routes();

Route::get('/', 'PagesController@index');
/* Route::get('/home', 'HomeController@index')->name('home');
 */
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
