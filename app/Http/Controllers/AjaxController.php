<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Services\Ajax\Service;

class AjaxController extends Controller
{

    protected $ajaxService;

    public function __construct(Service $ajaxService)
    {
        $this->ajaxService = $ajaxService;
    }

    public function changebio(Request $request)
    {
        $request->validate(['bio' => 'required|string|max:70']);

        return $this->ajaxService->change_user_bio(auth()->user()->id, $request->bio) ? 'SUCCESS' : 'FAIL';
    }

    public function changeavatar(Request $request)
    {
        $request->validate(['changeAvatar' => 'required|image|mimes:jpeg,png,jpg,gif|dimensions:min_width=180,min_height=180,max_width=2048,max_height=2048|max:2048']);

        return $this->ajaxService->change_user_avatar(auth()->user()->id, $request->file('changeAvatar')) ? 'SUCCESS' : 'FAIL';
    }

    public function deletepost(Request $request)
    {
        $request->validate(['id' => 'required|integer|min:1',
        'authorid' => 'integer|min:1',
    ]);

        return $this->ajaxService->delete_post($request->id, ($request->has('authorid')) ? $request->authorid : auth()->user()->id) ? 'SUCCESS' : 'FAIL';
    }

    public function createpost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|dimensions:min_width=180,min_height=180,max_width=20480,max_height=20480|max:102400',
            'title' => 'required|string|max:255|min:2',
            'content' => 'required|string|min:1',
            'category' => 'required|integer|min:1',
            'tags' => 'required|string|min:2',
        ]);

        return $this->ajaxService->create_post(auth()->user()->id, $request->file('image'), $request->title, $request->content, $request->category, $request->tags) ? 'SUCCESS' : 'FAIL';
    }

    public function updatepost(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:1',
            'tags' => 'required|string|min:2',
            'postid' => 'required|integer|min:1',
        ]);

        return $this->ajaxService->update_post($request->postid, auth()->user()->id, $request->content, $request->tags) ? 'SUCCESS' : 'FAIL';
    }

    public function createcomment(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:1',
            'postid' => 'required|integer|min:1',
        ]);

        return $this->ajaxService->create_comment($request->content, auth()->user()->id, $request->postid) ? 'SUCCESS' : 'FAIL';
    }

    public function dislikepost(Request $request)
    {
        $request->validate([
            'postid' => 'required|integer|min:1',
        ]);

        return  $this->ajaxService->dislike_post(auth()->user()->id, $request->postid);
    }

    public function likepost(Request $request)
    {
        $request->validate([
            'postid' => 'required|integer|min:1',
        ]);

        return $this->ajaxService->like_post(auth()->user()->id, $request->postid);
    }

    public function dislikecomment(Request $request)
    {
        $request->validate([
            'commentid' => 'required|integer|min:1',
        ]);

        return $this->ajaxService->dislike_comment(auth()->user()->id, $request->commentid);
    }

    public function likecomment(Request $request)
    {
        $request->validate([
            'commentid' => 'required|integer|min:1',
        ]);

        return $this->ajaxService->like_comment(auth()->user()->id, $request->commentid);
    }

    public function unbanuser(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|min:1',
        ]);

        return $this->ajaxService->unban_user($request->id);
    }

    public function banuser(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|min:1',
        ]);

        return $this->ajaxService->ban_user($request->id);
    }

    public function deletecomment(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|min:1',
        ]);

        return $this->ajaxService->delete_comment($request->id);
    }



    public function __invoke(Request $request)
    {
        return true;
    }
}
