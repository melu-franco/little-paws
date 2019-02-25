<?php


//Show web sections
Route::get('/', 'PagesController@index');
Route::get('/faq', 'PagesController@faq');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['middleware' => ['auth', 'verified']], function()
{
    //Posts controller
    Route::get('/home', 'FeedController@index')->name('feed');

    Route::post('/posts', 'PostsController@store')->name('post.store');
    Route::get('/posts/{post}/edit', 'PostsController@edit');
    Route::patch('/posts/{post}', 'PostsController@update');
    Route::patch('/posts/{post}/update_image', 'PostsController@update_image');
    Route::delete('/posts/{post}/delete_image', 'PostsController@delete_image');
    Route::delete('/posts/{post}', 'PostsController@destroy')->name('post.delete');
    Route::post('/posts/likes', 'PostsController@likes')->name('like');

    //Users controller
    Route::get('/profile/{user}', 'UserController@profile');
    Route::get('/profile/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::patch('/profile/{user}', 'UserController@update')->name('profile');
    Route::patch('/profile/{user}/update_avatar', 'UserController@update_avatar')->name('user-avatar.edit');
    Route::delete('/profile/{user}/delete_avatar', 'UserController@delete_avatar')->name('user-avatar.delete');
    Route::patch('/profile/{user}/update_cover', 'UserController@update_cover')->name('user-cover.edit');
    Route::delete('/profile/{user}/delete_cover', 'UserController@delete_cover')->name('user-cover.delete');
    Route::delete('/profile/{user}', 'UserController@destroy')->name('user.delete');

    //User Pet controller
    Route::get('/pet/{pet}', 'PetController@show')->name('pet.show');
    Route::get('/pet/{pet}/edit', 'PetController@edit')->name('pet.edit');
    Route::patch('/pet/{pet}', 'PetController@update')->name('pet.update');
    Route::patch('/pet/{pet}/update_avatar', 'PetController@update_avatar')->name('pet-avatar.edit');
    Route::delete('/pet/{pet}/delete_avatar', 'PetController@delete_avatar')->name('pet-avatar.delete');
    Route::delete('/pet/{pet}', 'PetController@destroy')->name('pet.delete');

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
    Route::get('/pet/{pet}/edit', 'PetController@edit')->name('pet.edit');
    Route::patch('/pet/{pet}', 'PetController@update');
    Route::patch('/pet/{pet}/update_avatar', 'PetController@update_image');
    Route::delete('/pet/{pet}/delete_avatar', 'PetController@delete_image');
    Route::delete('/pet/{pet}', 'PetController@destroy')->name('pet.delete');


});


