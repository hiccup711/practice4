<?php
// 基础页面
Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/about', 'StaticPagesController@about')->name('about');
Route::get('/help', 'StaticPagesController@help')->name('help');

// 用户URI
Route::resource('/users', 'UsersController');
// 用户激活
Route::get('/users/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

// 会话
Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store')->name('login');
Route::delete('/logout', 'SessionsController@destroy')->name('logout');

