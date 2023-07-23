<?php

namespace App\Http\Controllers\Blog;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Posts;
use App\Services\Posts\Service;

class BlogController extends Controller
{

    private $service;

    public function __construct(Service $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index($id, Request $request)
    {
        //If user is at own page -> redirect to /home
        if(auth()->user()->id == $id)
        {
            return redirect()->route('home');
        } 

        $userPosts = Posts::where('author_id', $id)->paginate(10);

        if ($request->ajax()) {
            return $this->service->format_paginative_posts_ajax($userPosts);
        }

        $lastestPosts = $latestPosts = Posts::orderBy('created_at', 'desc')->take(3)->get();;

        $pageTitle = 'Home - PostsStar';
        $activeLink = 'null';

        return view('home', compact('pageTitle', 'activeLink', 'userPosts', 'lastestPosts'));
        
    }
}
