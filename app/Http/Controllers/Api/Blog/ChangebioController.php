<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\ReadResource;
use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Http\Request;

use App\Services\Ajax\Service; //Just use ajax service methods to keep DRY

class ChangebioController extends Controller
{
    protected $ajaxService;

    public function __construct(Service $ajaxService)
    {
        $this->ajaxService = $ajaxService;
    }

    public function index(Request $request)
    {
        $request->validate(['bio' => 'required|string|max:70']);

        $status = $this->ajaxService->change_user_bio(auth('api')->user()->id, $request->bio);

        return ($status === true) ? response()->json(['message' => 'Successfully changed bio']) : response()->json(['message' => 'Error changing bio']); 
    }
}
