<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Post;
use App\Models\Posts;
use App\Models\Categories;
use App\Models\User;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'word' => 'required|string',
            'search' => 'string|max:56',
        ]);

        $pageTitle = 'Search - PostsStar';
        $activeLink = 'null';
        $mainTitle = 'Search results ';
        $searchCountResults = ["all"=>0, "posts"=>0, "blogs"=>0];

        $word = $request->input('word');
        $activeNavbar = $request->input('search') ? $request->input('search') : 'all';

        $posts = Posts::where('title', 'LIKE', "%$word%")->get();
        $users = User::where('name', 'LIKE', "%$word%")->get();

        $searchCountResults["posts"] = $posts->count();
        $searchCountResults["blogs"] = $users->count();
        $searchCountResults["all"] = $searchCountResults["blogs"] + $searchCountResults["posts"];

        switch($activeNavbar)
        {
            case "all":
                $mainTitle .= "(".$searchCountResults["all"].")";
                break;

            case "posts":
                $mainTitle .= "(".$searchCountResults["posts"].")";
                break;

            case "blogs":
                $mainTitle .= "(".$searchCountResults["blogs"].")";
                break;

            default:
                $mainTitle .= "(".$searchCountResults["all"].")";
                break;
        }
        
        return view('search', compact('pageTitle', 'activeLink', 'mainTitle', 'activeNavbar', 'searchCountResults', 'posts', 'users', 'word'));
    }
}
