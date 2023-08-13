<?php

namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\ReadResource;
use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Http\Request;

use App\Services\Ajax\Service; //Just use ajax service methods to keep DRY

class DislikeController extends Controller
{
    protected $ajaxService;

    public function __construct(Service $ajaxService)
    {
        $this->ajaxService = $ajaxService;
    }

    public function index(Request $request)
    {
        $request->validate([
            'commentid' => 'required|integer|min:1',
        ]);

        return $this->ajaxService->dislike_comment(auth('api')->user()->id, $request->commentid);
    }
}
