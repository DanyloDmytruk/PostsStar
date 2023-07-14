{{-- 
Left bar: edit photo and bio, create post form, user's posts
Right bar: Check posts, Top blogs, last posts 
--}}

@extends('layouts.main')

@section('main_content')
    <div class="d-flex mt-5">
        <div class="flex-fill">content item, will fill remaining</div>

        <div>
            <div class="flex-shrink-0 p-3" style="width: 280px;">
                <span class="fs-6 border-bottom">ARCHIVE POSTS</span>
                <a href="{{ route('posts') }}" class="d-flex align-items-center pb-3 mt-2 mb-3 link-dark text-decoration-none">
                    <span class="fs-6 fw-semibold"><i class="fa-solid fa-up-right-and-down-left-from-center"></i> Read Lastest Posts</span>
                </a>

                <span class="fs-6 border-bottom">TOP BLOGS</span>
                <a href="/" class="d-flex align-items-center pb-3 mb-3 mt-2 link-dark text-decoration-none ">
                    <span class="fs-6 fw-semibold"></span>
                </a>

                <span class="fs-6 border-bottom">LAST POSTS</span>
                <a href="/" class="d-flex align-items-center pb-3 mb-3 mt-2 link-dark text-decoration-none">
                    <span class="fs-6 fw-semibold"></span>
                </a>
                
            </div>
        </div>
    </div>
@endsection
