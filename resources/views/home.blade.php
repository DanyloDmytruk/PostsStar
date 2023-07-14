{{-- 
Left bar: edit photo and bio, create post form, user's posts
Right bar: Check posts, Top blogs, last posts 
--}}

@extends('layouts.main')

@section('main_content')
    <div class="d-flex mt-5">
        <div class="flex-fill">
            <div class="container border-bottom" style="padding-bottom: 1em">
                <div class="row justify-content-md-left">
                    <div class="col-md-1">
                        <img src="avatars/{{ auth()->user()->avatar }}" title="{{auth()->user()->name}}" style="border-radius: 5%; height: 4em">
                        
                    </div>

                    <div class="col-md-11">
                        <div class="row justify-content-md-left">
                            <div style="width: 2.1em; padding-right: 0">
                                <i style="font-size: 21px" class="fa-solid fa-circle-info"> </i>
                            </div>
                            <div class="col-11">
                                <input maxlength="70" style="width: 50em; margin-right: 0; padding-right: 0" placeholder="Enter your bio" class="border-0 mt-0 mb-0" value="{{ auth()->user()->bio }}">
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>

        <div>
            <div class="flex-shrink-0 p-3" style="width: 280px;">
                <span class="fs-6 border-bottom">ARCHIVE POSTS</span>
                <a href="{{ route('posts') }}"
                    class="d-flex align-items-center pb-3 mt-2 mb-3 link-dark text-decoration-none">
                    <span class="fs-6 fw-semibold"><i class="fa-solid fa-up-right-and-down-left-from-center"></i> Read
                        Lastest Posts</span>
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
