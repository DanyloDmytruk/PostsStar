<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostsResource;
use App\Models\Posts;
use Illuminate\Http\Request;

use App\Services\Ajax\Service; //Just use ajax service methods to keep DRY

class CreateController extends Controller
{
    protected $ajaxService;

    public function __construct(Service $ajaxService)
    {
        $this->ajaxService = $ajaxService;
    }

    public function index(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|dimensions:min_width=180,min_height=180,max_width=20480,max_height=20480|max:102400',
            'title' => 'required|string|max:255|min:2',
            'content' => 'required|string|min:1',
            'category' => 'required|integer|min:1',
            'tags' => 'required|string|min:2',
        ]);

        $status = $this->ajaxService->create_post(auth('api')->user()->id, $request->file('image'), $request->title, $request->content, $request->category, $request->tags);
        
        return ($status === true) ? response()->json(['message' => 'Post created successfully']) : response()->json(['message' => 'Error creating post']);
    }
}
