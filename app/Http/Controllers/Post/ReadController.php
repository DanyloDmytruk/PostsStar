<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;

use App\Http\Controllers\Post;
use App\Models\Posts;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Post\BaseController;
use App\Models\Categories;


class ReadController extends BaseController
{
    public function __invoke($id)
    {
        $post = Posts::find($id);
        $postComments = $post->comments;
        $userCommentsLiked = null;

        $pageTitle = $post->title.' - PostsStar';
        $activeLink = 'null';
        $mainTitle = $post->title;

        return view('post.read', compact('pageTitle', 'activeLink', 'mainTitle', 'post', 'postComments'));
    }
}
