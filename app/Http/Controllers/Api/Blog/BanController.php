<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\ReadResource;
use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Http\Request;
use App\Models\User;

class BanController extends Controller
{

    public function index(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|min:1',
        ]);

        if(auth('api')->user()->role === 'admin')
        {
            $user = User::find($request['id']);
            $user->is_banned = true;
            $user->save();

            return response()->json(['message' => 'Successfully banned user']);
        }

        return response()->json(['message' => 'Error banning user']);
    }
}
