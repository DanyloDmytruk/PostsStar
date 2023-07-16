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

    public function __invoke(Request $request)
    {
        $request->validate(['method' => 'required|string']);



        switch ($request->method) {
            case 'changebio':
                $this->ajaxService->change_user_bio(auth()->user()->id, $request->bio) ? 'SUCCESS' : 'FAIL';

                break;

            default:
                return 'FAIL';
        }
    }
}
