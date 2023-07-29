<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\Posts;
use App\Models\User;

class MainController extends Controller
{
    public function index()
    {  
        $totalPosts = Posts::count();
        $totalBlogs = User::count();

        $sevenDaysAgo = Carbon::now()->subDays(7);
        $lastWeekRegistrations = User::where('created_at', '>', $sevenDaysAgo)->get()->count();

        $bannedUsers = User::where('is_banned', true)->get()->count();

        return view('admin.main', compact('totalPosts', 'totalBlogs', 'lastWeekRegistrations', 'bannedUsers'));
    }
}
