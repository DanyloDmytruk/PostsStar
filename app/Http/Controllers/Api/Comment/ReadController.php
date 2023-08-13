<?php

namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\ReadResource;
use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Http\Request;

use App\Services\Ajax\Service; //Just use ajax service methods to keep DRY

class ReadController extends Controller
{
    protected $ajaxService;

    public function __construct(Service $ajaxService)
    {
        $this->ajaxService = $ajaxService;
    }

    public function index(Request $request)
    {
        if($request['id']){
            $comment = Comments::find($request['id']);

            return new ReadResource($comment);
        }
        else if($request['post_id']){
            $comments = Comments::where('post_id', $request['post_id'])->get();

            return ReadResource::collection($comments);
        }
        else
        {
            return response()->json(['message' => 'Error finding comment']);
        }

    }
}
