<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BannedController extends Controller
{
    public function __invoke()
    {   
        if(auth()->user()->is_banned == false)
        {
            return redirect()->route('home');
        }

        $pageTitle = 'You were banned';
        $activeLink = 'null';
        $mainTitle = 'Banned';

        return view('banned', compact('pageTitle', 'activeLink', 'mainTitle'));
    }
}
