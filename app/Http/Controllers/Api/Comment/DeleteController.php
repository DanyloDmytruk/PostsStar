<?php

namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\ReadResource;
use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Http\Request;

class DeleteController extends Controller
{ 

    public function index(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|min:1',
        ]);

        $comment = Comments::find($request['id']);

        if((auth('api')->user()->role === 'admin' || $comment->author->id === auth('api')->user()->id) && $comment)
        {
            $comment->delete();

            return response()->json(['message' => 'Successfully deleted comment']) ;
        }

        return response()->json(['message' => 'Error deleting comment']);
    }
}
