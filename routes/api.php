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

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});


Route::group(['namespace' => 'Api', 'middleware' => 'jwt.auth'], function(){
    
    Route::group(['prefix' => '/posts', 'namespace' => 'Posts'], function(){

        Route::post('/getall', 'PostsController@getall'); //get all posts; no params
        Route::post('/get', 'PostsController@get'); //get posts with pagination; page - page, per_page - posts per page

        Route::post('/create', 'CreateController@index'); //create post; image, title, content, category, tags; return 'message' in JSON
        Route::post('/read/{id}', 'ReadController@index'); //read post; id in url; return json of post
        Route::post('/update', 'UpdateController@index'); //update post; content, tags, postid; return 'message' in JSON
        Route::delete('/delete', 'DeleteController@index'); //delete post; id, authorid; return 'message' in JSON
        Route::post('/like', 'LikeController@index');     //like post; postid; return 'post_likes' as post likes count
        Route::post('/dislike', 'DisikeController@index');  //dislike post; postid; return 'post_likes' as post likes count
        
        

    });
});