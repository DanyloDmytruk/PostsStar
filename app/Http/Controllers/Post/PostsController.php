<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;

use App\Http\Controllers\Post;
use App\Models\Posts;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Post\BaseController;
use App\Models\Categories;


class PostsController extends BaseController
{
    public function __invoke()
    {
        $allPosts = Posts::paginate(10);

        $pageTitle = 'List of all posts - PostsStar';
        $activeLink = 'posts';
        $mainTitle = 'List of all posts';
        
        return view('post.posts', compact('pageTitle', 'activeLink', 'mainTitle', 'allPosts'));
    }
}
