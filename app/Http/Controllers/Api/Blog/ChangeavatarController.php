<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\ReadResource;
use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Http\Request;

use App\Services\Ajax\Service; //Just use ajax service methods to keep DRY

class ChangeavatarController extends Controller
{
    protected $ajaxService;

    public function __construct(Service $ajaxService)
    {
        $this->ajaxService = $ajaxService;
    }

    public function index(Request $request)
    {
        $request->validate(['changeAvatar' => 'required|image|mimes:jpeg,png,jpg,gif|dimensions:min_width=180,min_height=180,max_width=2048,max_height=2048|max:2048']);

        $status = $this->ajaxService->change_user_avatar(auth('api')->user()->id, $request->file('changeAvatar'));

        return ($status === true) ? response()->json(['message' => 'Successfully changed avatar']) : response()->json(['message' => 'Error changing avatar']); 
    }
}
