<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
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
        
        $searchCountResults = ["all"=>0, "posts"=>0, "blogs"=>0];

        $word = $request->input('word');

        $posts = Posts::where('title', 'LIKE', "%$word%")->get();
        $users = User::where('name', 'LIKE', "%$word%")->get();

        $searchCountResults["posts"] = $posts->count();
        $searchCountResults["blogs"] = $users->count();
        $searchCountResults["all"] = $searchCountResults["blogs"] + $searchCountResults["posts"];
        

        $result = collect(["searchCountResults" => $searchCountResults, "users" => $users, "posts" => $posts]);

        return $result;

    }
}
