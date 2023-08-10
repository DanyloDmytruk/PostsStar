<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;

use App\Http\Controllers\Post;
use App\Models\Posts;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Post\BaseController;
use App\Models\Categories;


class CreateController extends BaseController
{
    public function __invoke()
    {
        $categories = Categories::all();

        $pageTitle = 'Create post - PostsStar';
        $activeLink = 'null';
        $mainTitle = 'Create Post';
        
        return view('post.create', compact('pageTitle', 'activeLink', 'mainTitle', 'categories'));
    }

    
}
