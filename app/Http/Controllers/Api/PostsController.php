<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostsResource;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function getall()
    {
        $posts = Posts::all();

        return PostsResource::collection($posts);
    }

    public function get(Request $request)
    {
        $perPage = $request['per_page'] ?? 10;
        $page = $request['page'] ?? 1;

        $posts = Posts::paginate($perPage, ['*'], 'page', $page);

        return PostsResource::collection($posts);
    }
}
