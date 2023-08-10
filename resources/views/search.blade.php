@extends('layouts.main')

@inject('service', 'App\Services\Posts\Service')
@section('main_content')
    <div class="nav-scroller">
        <nav class="nav nav-underline">
            <a class="nav-link {{ $activeNavbar === 'all' || !$activeNavbar ? 'active' : '' }}"
                href="{{ route('search', ['word' => $word, 'search' => 'all']) }}">All
                <span class="badge badge-success bg-primary align-text-bottom">{{ $searchCountResults['all'] }}</span>
            </a>
            <a class="nav-link {{ $activeNavbar === 'blogs' ? 'active' : '' }}"
                href="{{ route('search', ['word' => $word, 'search' => 'blogs']) }}">
                Blogs
                <span class="badge badge-success bg-success align-text-bottom">{{ $searchCountResults['blogs'] }}</span>
            </a>
            <a class="nav-link {{ $activeNavbar === 'posts' ? 'active' : '' }}"
                href="{{ route('search', ['word' => $word, 'search' => 'posts']) }}">
                Posts
                <span class="badge badge-pill bg-danger align-text-bottom">{{ $searchCountResults['posts'] }}</span>
            </a>
        </nav>
    </div>
    <div class="d-flex mt-4">
        <div class="flex-fill">
            <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 80em;">

                <div class="list-group list-group-flush border-bottom scrollarea">


                    @if ($activeNavbar === 'all' || !$activeNavbar)
                        @foreach ($posts as $post)
                            <a href="{{ route('posts.read', ['id' => $post->id]) }}"
                                class="list-group-item list-group-item-action py-2 lh-sm">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <strong class="mb-1">{{ $post->title }}</strong>
                                    <small class="text-muted">{{ date('H:i j/n/Y', strtotime($post->created_at)) }}</small>
                                </div>
                                <div class="col-10 mb-0 small">
                                    {{ Str::length($post->content) > 60 ? $service->trim_post_content_for_list(80, $post->content) . '...' : $post->content }}
                                </div>
                                <div class="col-10 mb-0 small"><span class="text-primary">Category:</span>
                                    {{ $post->category->title }}</div>
                                <div class="col-10 mb-0 small"><span class="text-success">Tags:</span>
                                    @foreach ($post->tags as $tag)
                                        <i class="fa-solid fa-tag"></i> {{ $tag->title }}
                                    @endforeach
                                </div>
                            </a>
                        @endforeach


                        @foreach ($users as $user)
                            <a href="{{ route('blog', ['id' => $user->id]) }}"
                                class="list-group-item list-group-item-action py-2 lh-sm">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="{{ asset('avatars/' . $user->avatar) }}" title="{{ $user->name }}"
                                                style="border-radius: 5%; height: 4em; width: 4em">
                                        </div>
                                        <div class="col-md-11">
                                            <div class="d-flex w-100 align-items-center justify-content-between">
                                                <strong class="mb-1">{{ $user->name }}</strong>
                                            </div>
                                            <div class="d-flex w-100 align-items-center">
                                                <i style="font-size: 19px; margin-right: 4px"
                                                    class="fa-solid fa-circle-info"></i><label class="text-muted">
                                                    {{ $user->bio ? $user->bio : 'Blogging at PostsStar!' }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @elseif($activeNavbar === 'blogs')
                        @foreach ($users as $user)
                            <a href="{{ route('blog', ['id' => $user->id]) }}"
                                class="list-group-item list-group-item-action py-2 lh-sm">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="{{ asset('avatars/' . $user->avatar) }}" title="{{ $user->name }}"
                                                style="border-radius: 5%; height: 4em; width: 4em">
                                        </div>
                                        <div class="col-md-11">
                                            <div class="d-flex w-100 align-items-center justify-content-between">
                                                <strong class="mb-1">{{ $user->name }}</strong>
                                            </div>
                                            <div class="d-flex w-100 align-items-center">
                                                <i style="font-size: 19px; margin-right: 4px"
                                                    class="fa-solid fa-circle-info"></i><label class="text-muted">
                                                    {{ $user->bio ? $user->bio : 'Blogging at PostsStar!' }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @elseif($activeNavbar === 'posts')
                        @foreach ($posts as $post)
                            <a href="{{ route('posts.read', ['id' => $post->id]) }}"
                                class="list-group-item list-group-item-action py-2 lh-sm">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <strong class="mb-1">{{ $post->title }}</strong>
                                    <small class="text-muted">{{ date('H:i j/n/Y', strtotime($post->created_at)) }}</small>
                                </div>
                                <div class="col-10 mb-0 small">
                                    {{ Str::length($post->content) > 60 ? $service->trim_post_content_for_list(80, $post->content) . '...' : $post->content }}
                                </div>
                                <div class="col-10 mb-0 small"><span class="text-primary">Category:</span>
                                    {{ $post->category->title }}</div>
                                <div class="col-10 mb-0 small"><span class="text-success">Tags:</span>
                                    @foreach ($post->tags as $tag)
                                        <i class="fa-solid fa-tag"></i> {{ $tag->title }}
                                    @endforeach
                                </div>
                            </a>
                        @endforeach
                    @endif



                </div>


            </div>


        </div>
    @endsection
