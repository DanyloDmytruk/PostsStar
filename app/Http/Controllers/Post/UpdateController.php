<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;

use App\Http\Controllers\Post;
use App\Models\Posts;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Post\BaseController;
use App\Models\Categories;


class UpdateController extends BaseController
{
    public function __invoke()
    {
        $categories = Categories::all();

        $pageTitle = 'Update post - PostsStar';
        $activeLink = 'null';
        $mainTitle = 'Update Post';
        
        return view('post.update', compact('pageTitle', 'activeLink', 'mainTitle', 'categories'));
    }

    
}
