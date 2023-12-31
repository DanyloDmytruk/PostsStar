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
    public function __invoke($id)
    {
        $categories = Categories::all();
        $post = Posts::find($id);

        if(auth()->user()->id != $post->author_id)
        {
            abort(403, 'You do not have access to view this page.');
        }


        $pageTitle = 'Update post - PostsStar';
        $activeLink = 'null';
        $mainTitle = 'Update Post';
        
        return view('post.update', compact('pageTitle', 'activeLink', 'mainTitle', 'categories', 'post'));
    }

    
}
