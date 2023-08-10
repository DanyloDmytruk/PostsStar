<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Post;
use App\Models\Posts;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Post\BaseController;
use App\Models\Categories;


class AboutController extends BaseController
{
    public function __invoke()
    {
        $pageTitle = 'About - PostsStar';
        $activeLink = 'about';
        $mainTitle = 'About PostsStar';

        
        return view('about', compact('pageTitle', 'activeLink', 'mainTitle'));
    }
}
