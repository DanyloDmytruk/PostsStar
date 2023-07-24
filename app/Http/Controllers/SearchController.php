<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Post;
use App\Models\Posts;
use App\Models\Categories;


class SearchController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = 'Search - PostsStar';
        $activeLink = 'null';
        $mainTitle = 'Search results (5300)';

        
        dd('Search');
    }
}
