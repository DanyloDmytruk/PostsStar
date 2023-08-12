<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostsResource;
use App\Models\Posts;
use Illuminate\Http\Request;

use App\Services\Ajax\Service; //Just use ajax service methods to keep DRY

class DeleteController extends Controller
{
    protected $ajaxService;

    public function __construct(Service $ajaxService)
    {
        $this->ajaxService = $ajaxService;
    }

    public function index(Request $request)
    {
        $request->validate(['id' => 'required|integer|min:1',
        'authorid' => 'integer|min:1',
        ]);

        $this->ajaxService->delete_post($request->id, ($request->has('authorid')) ? $request->authorid : auth('api')->user()->id);
        
        $status = true;

        return ($status === true) ? response()->json(['message' => 'Post deleted successfully']) : response()->json(['message' => 'Error deleting post']);
    }
}
