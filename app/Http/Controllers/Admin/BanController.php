<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\Posts;
use App\Models\User;

class BanController extends Controller
{
    public function index()
    {  
        $mainTitle = "Banned Users";
        $activeElement = "ban";
        $bannedUsers = User::where('is_banned', true)->get();

        return view('admin.ban', compact('mainTitle', 'activeElement', 'bannedUsers'));
    }
}
