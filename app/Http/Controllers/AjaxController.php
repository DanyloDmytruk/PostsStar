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
        $request->validate(['id' => 'required|integer|min:1',]);

        return $this->ajaxService->delete_post($request->id, auth()->user()->id) ? 'SUCCESS' : 'FAIL';
    }

    public function createpost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|dimensions:min_width=180,min_height=180,max_width=20480,max_height=20480|max:102400',
            'title' => 'required|string|max:255|min:2',
            'content' => 'required|string|min:1',
            'category' => 'required|integer|min:1',
            'tags' => 'required|string|min:1',
        ]);

        return $this->ajaxService->create_post(auth()->user()->id, $request->file('image'), $request->title, $request->content, $request->category, $request->tags) ? 'SUCCESS' : 'FAIL';
    }

    public function __invoke(Request $request)
    {
        return true;
    }
}
