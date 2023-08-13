<?php

namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\ReadResource;
use App\Models\Comments;
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
            'content' => 'required|string|min:1',
            'postid' => 'required|integer|min:1',
        ]);

        $status = $this->ajaxService->create_comment($request->content, auth('api')->user()->id, $request->postid);

        return ($status === true) ? response()->json(['message' => 'Successfully created comment']) : response()->json(['message' => 'Error creating comment']); 
    }
}
