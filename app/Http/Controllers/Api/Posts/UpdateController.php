<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostsResource;
use App\Models\Posts;
use Illuminate\Http\Request;

use App\Services\Ajax\Service; //Just use ajax service methods to keep DRY

class UpdateController extends Controller
{
    protected $ajaxService;

    public function __construct(Service $ajaxService)
    {
        $this->ajaxService = $ajaxService;
    }

    public function index(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:1',
            'tags' => 'required|string|min:2',
            'postid' => 'required|integer|min:1',
        ]);

        $status = $this->ajaxService->update_post($request->postid, auth('api')->user()->id, $request->content, $request->tags);
        
        return ($status === true) ? response()->json(['message' => 'Post updated successfully']) : response()->json(['message' => 'Error updating post']);
    }
}
