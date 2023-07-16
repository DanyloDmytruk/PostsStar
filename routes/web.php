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

Route::group(['middleware'=>'user'], function(){
    Route::get('/', "HomeController@index");
    Route::get('/home', "HomeController@index")->name('home');
    
    Route::group(['namespace'=>'Post'], function(){
        Route::get('/posts', 'PostsController')->name('posts');
    
        Route::group(['prefix'=>'post'], function(){
            //Route::get('/edit/{id}', 'PostsController')->name('posts.edit');
            Route::get('/read/{id}', 'ReadController')->name('posts.read');
        });
    });

    Route::get('/logout', function(){
        Auth::logout();
        return redirect()->route('login');
    });

    Route::post('/ajax', 'AjaxController');
    
});

Route::get('/banned', "BannedController")->name('banned');


Route::get('/about', 'AboutController')->name('about');



Auth::routes();
