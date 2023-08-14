<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login'); //login; login (username or email), password; return token
    Route::post('register', 'AuthController@register'); //register; avatar(image), name, email, password; return token
    Route::post('logout', 'AuthController@logout'); //logout
    Route::post('refresh', 'AuthController@refresh'); //refresh token
    Route::post('me', 'AuthController@me'); //return user ingo
});


Route::group(['namespace' => 'Api', 'middleware' => 'jwt.auth'], function () {

    Route::group(['middleware' => 'userAPI'], function () {

        Route::group(['prefix' => '/posts', 'namespace' => 'Posts'], function () {

            Route::post('/getall', 'PostsController@getall'); //get all posts; no params
            Route::post('/get', 'PostsController@get'); //get posts with pagination; page - page, per_page - posts per page

            Route::post('/create', 'CreateController@index'); //create post; image, title, content, category, tags; return 'message' in JSON
            Route::post('/read/{id}', 'ReadController@index'); //read post; id in url; return json of post
            Route::post('/update', 'UpdateController@index'); //update post; content, tags, postid; return 'message' in JSON
            Route::delete('/delete', 'DeleteController@index'); //delete post; id, authorid; return 'message' in JSON
            Route::post('/like', 'LikeController@index'); //like post; postid; return 'post_likes' as post likes count
            Route::post('/dislike', 'DisikeController@index'); //dislike post; postid; return 'post_likes' as post likes count

        });

        Route::group(['prefix' => '/comment', 'namespace' => 'Comment'], function () {

            Route::post('/create', 'CreateController@index'); //create comment; content, postid; return 'message' in JSON
            Route::post('/read', 'ReadController@index'); //get comment(s) content by id or post_id; id|post_id
            Route::post('/update', 'UpdateController@index'); //update comment content by id; id; return 'message' in JSON
            Route::delete('/delete', 'DeleteController@index'); //delete comment by id; id; return 'message' in JSON
            Route::post('/like', 'LikeController@index'); //like comment by id; commentid; return count of likes
            Route::post('/dislike', 'DislikeController@index'); //dislike comment by commentid; id; return count of likes

        });

        Route::group(['prefix' => '/blog', 'namespace' => 'Blog'], function(){
           
           Route::post('/ban', 'BanController@index'); //ban user; id; return 'message' in JSON
           Route::post('/unban', 'UnbanController@index'); //unban user; id; return 'message' in JSON
           Route::post('/changebio', 'ChangebioController@index'); //change (self) user's bio; bio; return 'message' in JSON
           Route::post('/changeavatar', 'ChangeavatarController@index'); //change (self) avatar; changeAvatar (as image file); return 'message' in JSON
           
        });

        Route::post('/search', 'SearchController@index'); //search posts and users by word; word, search; return JSON of results

    });

});