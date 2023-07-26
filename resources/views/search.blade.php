@extends('layouts.main')

@inject('service', 'App\Services\Posts\Service')
@section('main_content')
    <div class="d-flex mt-5">
        <div class="flex-fill">
            <div class="container border-bottom" style="padding-bottom: 1em; margin-bottom: 1em">
                <div class="row justify-content-md-left">
                    <div class="col-md-1">
                        <img src="avatars/{{ auth()->user()->avatar }}" title="{{ auth()->user()->name }}"
                            style="border-radius: 5%; height: 5em; width: 5em">
                        <a data-toggle="modal" data-target="#myModal" href="#" id="photoLink"><small class="fs-8"><i
                                    class="fa-solid fa-pen-to-square"></i>
                                Photo</small></button></a>
                    </div>

                    <div class="col-md-auto">
                        <div class="row justify-content-md-left mb-2">
                            <div style="width: 2.1em; padding-right: 0">
                                <i style="font-size: 21px" class="fa-solid fa-circle-info"> </i>
                            </div>
                            <div class="col-11">
                                <input id="bio" maxlength="70" style="width: 50em; margin-right: 0; padding-right: 0"
                                    placeholder="Enter your bio" class="border-0 mt-0 mb-0"
                                    value="{{ auth()->user()->bio }}">
                            </div>
                        </div>

                        <div class="row justify-content-md-left">
                            <div style="width: 2.1em; padding-right: 0">
                                <i style="font-size: 20px" class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="col-11">
                                <label>{{ auth()->user()->email }}</label>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            
        </div>

        <div>
            <div class="flex-shrink-0 p-3" style="width: 280px;">
                {{-- <div>
                    <span class="fs-6 border-bottom">ARCHIVE POSTS</span>
                    <a href="{{ route('posts') }}"
                        class="d-flex align-items-center pb-3 mt-2 mb-3 link-dark text-decoration-none">
                        <span class="fs-6 fw-semibold"><i class="fa-solid fa-up-right-and-down-left-from-center"></i> Read
                            Lastest Posts</span>
                    </a>
                </div>

                <div class="mb-3">
                    <span class="fs-6 border-bottom">TOP BLOGS</span>
                    @foreach ($topBlogs as $topBlog)
                        <a href="{{ route('posts.read', ['id' => $topBlog->id]) }}"
                            class="d-flex link-dark text-decoration-none">
                            <span class="fs-6 fw-semibold mb-1"><i class="fa-regular fa-user"></i>
                                {{ $topBlog->name }}</span><br>
                        </a>
                    @endforeach
                </div>

                <div>
                    <span class="fs-6 border-bottom">LAST POSTS</span>
                    @foreach ($lastestPosts as $latestPost)
                        <a href="{{ route('posts.read', ['id' => $latestPost->id]) }}"
                            class="d-flex link-dark text-decoration-none">
                            <span class="fs-6 fw-semibold mb-1"><i class="fa-regular fa-comment"></i>
                                {{ $latestPost->title }}</span><br>
                        </a>
                    @endforeach
                </div> --}}

            </div>
        </div>
    </div>




@endsection
