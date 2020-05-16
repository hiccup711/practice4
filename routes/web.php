<?php
// 基础页面
Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/about', 'StaticPagesController@about')->name('about');
Route::get('/help', 'StaticPagesController@help')->name('help');

// 用户URI
Route::resource('/users', 'UsersController');
// 用户激活
Route::get('/users/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');
// 找回密码
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
// 会话
Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store')->name('login');
Route::delete('/logout', 'SessionsController@destroy')->name('logout');
// 发布微博与删除微博
Route::post('/statuses', 'StatusesController@store')->name('statuses.store');
Route::delete('/statuses/{status}', 'StatusesController@destroy')->name('statuses.destroy');

// 关注人列表与粉丝列表
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');
Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');

// 关注与取关
Route::post('/follow/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('/unfollow/{user}', 'FollowersController@destroy')->name('followers.destroy');
