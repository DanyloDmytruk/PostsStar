<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Posts\Service;

class HomeController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Service $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        
        $userPosts = Posts::where('author_id', auth()->user()->id)->paginate(10);

        if ($request->ajax()) {
            return $this->service->format_paginative_posts_ajax($userPosts);
        }

        $lastestPosts = Posts::orderBy('created_at', 'desc')->take(3)->get();

        $pageTitle = 'Home - PostsStar';
        $activeLink = 'home';

        $topBlogs = $this->service->getTopBlogs();

        return view('home', compact('pageTitle', 'activeLink', 'userPosts', 'lastestPosts', 'topBlogs'));
    }
}
