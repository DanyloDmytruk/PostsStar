<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostsResource;
use App\Models\Posts;
use Illuminate\Http\Request;
use App\Http\Resources\Posts\ReadResource;

use App\Services\Ajax\Service; //Just use ajax service methods to keep DRY

class ReadController extends Controller
{
    protected $ajaxService;

    public function __construct(Service $ajaxService)
    {
        $this->ajaxService = $ajaxService;
    }

    public function index($id)
    {
        $post = Posts::find($id);
        $post['me_liked'] = in_array(auth('api')->user()->id, array_column($post->usersLiked->toArray(), 'id')) ? true : false;
        
        return new ReadResource($post);
    }
}
