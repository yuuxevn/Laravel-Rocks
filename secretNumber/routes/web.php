<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('posts', 'PostController@index')->name('posts.index');

Route::prefix('posts')->middleware('auth')->group(function () {
    Route::get('create', 'PostController@create')->name('posts.create');
    // insert kedalam database
    Route::post('store', 'PostController@store');
    Route::get('{post:slug}/edit', 'PostController@edit');
    // update kedalam database
    // bisa menggunakan put(update semua) & patch(update beberapa saja)
    Route::patch('{post:slug}/edit', 'PostController@update');
    //delete post
    Route::delete('{post:slug}/delete', 'PostController@destroy');
});

Route::get('posts/{post:slug}', 'PostController@show');
//Route categories
Route::get('categories/{category:slug}', 'CategoryController@show');

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
