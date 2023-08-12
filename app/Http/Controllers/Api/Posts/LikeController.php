<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostsResource;
use App\Models\Posts;
use Illuminate\Http\Request;

use App\Services\Ajax\Service; //Just use ajax service methods to keep DRY

class PostsController extends Controller
{
    protected $ajaxService;

    public function __construct(Service $ajaxService)
    {
        $this->ajaxService = $ajaxService;
    }

    public function index(Request $request)
    {
        $request->validate([
            'postid' => 'required|integer|min:1',
        ]);

        $postLikes = $this->ajaxService->like_post(auth('api')->user()->id, $request->postid);
        
        return response()->json(['post_likes' => $postLikes]);
    }
}
