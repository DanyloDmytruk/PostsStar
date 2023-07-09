<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace'=>'Post'], function(){
    Route::get('/posts', 'PostsController')->name('posts');

    Route::group(['prefix'=>'post'], function(){
        //Route::get('/edit/{id}', 'PostsController')->name('posts.edit');
        Route::get('/read/{id}', 'ReadController')->name('posts.read');
    });
});

Route::get('/about', 'AboutController')->name('about');


