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

    public function __invoke(Request $request)
    {
        return true;
    }
}
