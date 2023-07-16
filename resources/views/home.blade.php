{{-- 
Left bar: edit photo and bio, create post form, user's posts
Right bar: Check posts, Top blogs, last posts 
--}}

@extends('layouts.main')

@section('main_content')
    <div class="d-flex mt-5">
        <div class="flex-fill">
            <div class="container border-bottom" style="padding-bottom: 1em; margin-bottom: 1em">
                <div class="row justify-content-md-left">
                    <div class="col-md-1">
                        <img src="avatars/{{ auth()->user()->avatar }}" title="{{ auth()->user()->name }}"
                            style="border-radius: 5%; height: 5em">
                        <small class="fs-8"><i class="fa-solid fa-pen-to-square"></i> Photo</small>
                    </div>

                    <div class="col-md-auto">
                        <div class="row justify-content-md-left mb-2">
                            <div style="width: 2.1em; padding-right: 0">
                                <i style="font-size: 21px" class="fa-solid fa-circle-info"> </i>
                            </div>
                            <div class="col-11">
                                <input maxlength="70" style="width: 50em; margin-right: 0; padding-right: 0"
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

            <div class="container border-bottom" style="padding-bottom: 1em">
                <div class="row justify-content-md-left mb-1">
                    <button type="button" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Create New
                        Post</button>
                </div>

                <div class="list-group list-group-flush border-bottom border-primary scrollarea">
                    <a href="#" class="list-group-item list-group-item-action py-2 lh-sm ">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Title</strong>
                            <small class="text-muted">11</small>
                        </div>
                        <div class="col-10 mb-0 small">1499</div>
                        <div class="col-10 mb-0 small"><span class="text-primary">Category:</span>111</div>
                        <div class="col-10 mb-0 small"><span class="text-success">Tags:</span>

                            <i class="fa-solid fa-tag"></i> 111
                        </div>
                    </a>
                </div>

                <div class="list-group list-group-flush border-bottom border-primary scrollarea">
                    <a href="#" class="list-group-item list-group-item-action py-2 lh-sm ">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Title</strong>
                            <small class="text-muted">11</small>
                        </div>
                        <div class="col-10 mb-0 small">1499</div>
                        <div class="col-10 mb-0 small"><span class="text-primary">Category:</span>111</div>
                        <div class="col-10 mb-0 small"><span class="text-success">Tags:</span>

                            <i class="fa-solid fa-tag"></i> 111
                        </div>
                    </a>
                </div>

                <div class="list-group list-group-flush border-bottom scrollarea border-primary">
                    <a href="#" class="list-group-item list-group-item-action py-2 lh-sm">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Title</strong>
                            <small class="text-muted">11</small>
                        </div>
                        <div class="col-10 mb-0 small">1499</div>
                        <div class="col-10 mb-0 small"><span class="text-primary">Category:</span>111</div>
                        <div class="col-10 mb-0 small"><span class="text-success">Tags:</span>

                            <i class="fa-solid fa-tag"></i> 111
                        </div>
                    </a>
                </div>

                <div class="list-group list-group-flush border-bottom scrollarea border-primary">
                    <a href="#" class="list-group-item list-group-item-action py-2 lh-sm">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Title</strong>
                            <small class="text-muted">11</small>
                        </div>
                        <div class="col-10 mb-0 small">1499</div>
                        <div class="col-10 mb-0 small"><span class="text-primary">Category:</span>111</div>
                        <div class="col-10 mb-0 small"><span class="text-success">Tags:</span>

                            <i class="fa-solid fa-tag"></i> 111
                        </div>
                    </a>
                </div>

                <div class="list-group list-group-flush border-bottom scrollarea border-primary">
                    <a href="#" class="list-group-item list-group-item-action py-2 lh-sm">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Title</strong>
                            <div class="d-flex justify-content-end">
                                <div class="p-1">
                                    <small class="text-muted">del up</small>
                                </div>
                                <div class="p-1">
                                    <small class="text-muted">02/12/2023</small>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-10 mb-0 small">1499</div>
                        <div class="col-10 mb-0 small"><span class="text-primary">Category:</span>111</div>
                        <div class="col-10 mb-0 small"><span class="text-success">Tags:</span>

                            <i class="fa-solid fa-tag"></i> 111
                        </div>
                    </a>
                </div>

                <div class="container">
                    <div class="row justify-content-md-center mb-1 mt-2">
                        <div class="col-md-auto">
                            <button type="button" class="btn btn-secondary"><i class="fa-solid fa-spinner"></i> Load Other </button>
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
