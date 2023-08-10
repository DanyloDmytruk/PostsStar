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

Route::group(['middleware' => 'user'], function () {
    //Home
    Route::get('/', "HomeController@index");
    Route::get('/home', "HomeController@index")->name('home');

    //Post(s)
    Route::group(['namespace' => 'Post'], function () {
        Route::get('/posts', 'PostsController')->name('posts');

        Route::group(['prefix' => 'post'], function () {
            Route::get('/read/{id}', 'ReadController')->name('posts.read');
            Route::get('/create', 'CreateController')->name('posts.create');
            Route::get('/update/{id}', 'UpdateController')->name('posts.update');
        });
    });

    //Blog
    Route::group(['namespace' => 'Blog'], function () {

        Route::group(['prefix' => 'blog'], function () {
            Route::get('/{id}', 'BlogController@index')->name('blog');
        });
    });


    //Logout
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    });

    //Ajax
    Route::post('/ajax', 'AjaxController')->name('ajax');
    Route::group(['prefix' => 'ajax'], function () {
        Route::post('/changebio', 'AjaxController@changebio')->name('ajax.changebio');
        Route::post('/changeavatar', 'AjaxController@changeavatar')->name('ajax.changeavatar');
        Route::post('/createpost', 'AjaxController@createpost')->name('ajax.createpost');
        Route::delete('/deletepost', 'AjaxController@deletepost')->name('ajax.deletepost');
        Route::post('/updatepost', 'AjaxController@updatepost')->name('ajax.updatepost');
        Route::post('/createcomment', 'AjaxController@createcomment')->name('ajax.createcomment');
        Route::post('/likepost', 'AjaxController@likepost')->name('ajax.likepost');
        Route::post('/dislikepost', 'AjaxController@dislikepost')->name('ajax.dislikepost');
        Route::post('/likecomment', 'AjaxController@likecomment')->name('ajax.likecomment');
        Route::post('/dislikecomment', 'AjaxController@dislikecomment')->name('ajax.dislikecomment');
        Route::post('/unbanuser', 'AjaxController@unbanuser')->name('ajax.unbanuser');
        Route::post('/banuser', 'AjaxController@banuser')->name('ajax.banuser');
        Route::delete('/deletecomment', 'AjaxController@deletecomment')->name('ajax.deletecomment');
    });

    //Seachbar
    Route::get('/search', 'SearchController@index')->name('search');
});

Route::group(['middleware' => 'admin'], function () {
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('/admin', 'MainController@index')->name('admin');
        Route::get('/ban', 'BanController@index')->name('admin.ban');
        Route::get('/banuser', 'BanUserController@index')->name('admin.banuser');
        
    });
});

//Banned
Route::get('/banned', "BannedController")->name('banned');

//About
Route::get('/about', 'AboutController')->name('about');



Auth::routes();
