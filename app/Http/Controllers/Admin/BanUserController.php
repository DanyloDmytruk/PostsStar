<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\Posts;
use App\Models\User;

class BanUserController extends Controller
{
    public function index()
    {  
        $mainTitle = "Unbaned Users List";
        $activeElement = "ban";
        $unbannedUsers = User::where('is_banned', false)->get();

        return view('admin.banuser', compact('mainTitle', 'activeElement', 'unbannedUsers'));
    }
}
