<?php


//Show web sections
Route::get('/', 'PagesController@index');
Route::get('/faq', 'PagesController@faq');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['middleware' => ['auth', 'verified']], function()
{
    //Posts controller
    Route::get('/home', 'PostsController@getFeed')->name('posts');
    Route::post('/posts', 'PostsController@store')->name('post.store');
    Route::get('/posts/{post}/edit', 'PostsController@edit');
    Route::patch('/posts/{post}', 'PostsController@update');
    Route::patch('/posts/{post}/update_image', 'PostsController@update_image');
    Route::delete('/posts/{post}/delete_image', 'PostsController@delete_image');
    Route::delete('/posts/{post}', 'PostsController@destroy')->name('post.delete');
    Route::post('/posts/likes', 'PostController@likes')->name('like');

    //Users controller
    Route::get('/profile/{user}', 'UserController@profile');
    Route::get('/profile/{user}/edit', 'UserController@edit');
    Route::patch('/profile/{user}', 'UserController@update')->name('profile');
    Route::patch('/profile/{user}/update_avatar', 'UserController@update_avatar')->name('profile-edit');
    Route::delete('/profile/{user}/delete_avatar', 'UserController@delete_avatar');
    Route::patch('/profile/{user}/update_cover', 'UserController@update_cover');
    Route::delete('/profile/{user}/delete_cover', 'UserController@delete_cover');
    Route::delete('/profile/{user}', 'UserController@destroy');

    //Follow users
    Route::get('/users', 'UserController@show')->name('users');
    Route::post('profile/{user}/follow', 'UserController@follow_user')->name('user.follow');
    Route::post('/{user}/unfollow', 'UserController@unfollow_user')->name('user.unfollow');

    //Comments
    Route::post('/comment/store', 'CommentController@store')->name('comment.add');
    Route::delete('/comment/{comment}', 'CommentController@destroy')->name('comment.delete');

    //Search users
    Route::get('/search', 'SearchController@search')->name('search');

    Route::view('/register-success', 'dashboard.register-success');

    Route::get('/pet-create', 'PetController@create')->name('pet.create');
    Route::post('/pet', 'PetController@store')->name('pet.store');
    Route::get('/pet/{pet}', 'PetController@show');
    Route::get('/pet/{pet}/edit', 'PetController@edit');
    Route::patch('/pet/{pet}', 'PetController@update');
    Route::patch('/pet/{pet}/update_image', 'PetController@update_image');
    Route::delete('/pet/{pet}/delete_image', 'PetController@delete_image');
    Route::delete('/pet/{pet}', 'PetController@destroy')->name('pet.delete');


});


