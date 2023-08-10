@extends('layouts.main')

@inject('service', 'App\Services\Posts\Service')
@section('main_content')
    <div class="d-flex mt-5">
        <div class="flex-fill">
            <div class="container border-bottom" style="padding-bottom: 1em; margin-bottom: 1em">
                <div class="row justify-content-md-left">
                    <div class="col-md-1" style="margin-right:12px">
                        
                            <div class="container">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <img src="{{ asset('avatars/' . $userBlog->avatar) }}" title="{{ $userBlog->name }}"
                                            style="border-radius: 5%; height: 5em; width: 5em">
                                    </div>
                                    <div class="col-lg-12 text-center">

                                        <label>{{ $userBlog->name }}</label>

                                    </div>
                                </div>
                            </div>
                        
                    </div>

                    <div class="col-md-10">
                        <div class="row justify-content-md-left mb-2">
                            <div style="width: 2.1em; padding-right: 0">
                                <i style="font-size: 21px" class="fa-solid fa-circle-info"> </i>
                            </div>
                            <div class="col-11">
                                <input id="bio" maxlength="70" style="width: 50em; margin-right: 0; padding-right: 0"
                                    placeholder="Blogging at PostsStar!" class="border-0 mt-0 mb-0" value="{{ $userBlog->bio }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="row justify-content-md-left">
                            <div style="width: 2.1em; padding-right: 0">
                                <i style="font-size: 20px" class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="col-11">
                                <label>{{ $userBlog->email }}</label>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="container border-bottom" style="padding-bottom: 1em">
                <div class="row justify-content-md-center border-bottom border-danger mb-1 text-center">
                    <h5>User's Posts</h5>
                </div>

                <div id="postContainer">
                    @foreach ($userPosts as $userPost)
                        <div class="list-group list-group-flush border-bottom scrollarea border-primary">
                            <a href="{{ route('posts.read', ['id' => $userPost->id]) }}"
                                class="list-group-item list-group-item-action py-2 lh-sm">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <strong class="mb-1">{{ $userPost->title }}</strong>
                                    <div class="d-flex justify-content-end">
                                        <div class="p-1">
                                            <small
                                                class="text-muted">{{ $service->get_post_date(strtotime($userPost->created_at)) }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 mb-0 small">
                                    {{ Str::length($userPost->content) > 60 ? $service->trim_post_content_for_list(80, $userPost->content) . '...' : $userPost->content }}
                                </div>
                                <div class="col-10 mb-0 small"><span
                                        class="text-primary">Category:</span>{{ $userPost->category->title }}</div>
                                <div class="col-10 mb-0 small"><span class="text-success">Tags:</span>
                                    @foreach ($userPost->tags as $tag)
                                        <i class="fa-solid fa-tag"></i> {{ $tag->title }}
                                    @endforeach
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                @if ($userPosts->total() > 5)
                    <div class="container">
                        <div class="row justify-content-md-center mb-1 mt-2">
                            <div class="col-md-auto">
                                <button type="button" id="loadMoreBtn" class="btn btn-secondary"><i
                                        class="fa-solid fa-spinner" id="loadmoreIcon"></i> Load
                                    More </button>
                            </div>
                            <input type="hidden" id="currentPage" value="1">
                        </div>
                    </div>
                @endif


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
                @foreach ($lastestPosts as $latestPost)
                    <a href="{{ route('posts.read', ['id' => $latestPost->id]) }}"
                        class="d-flex link-dark text-decoration-none">
                        <span class="fs-6 fw-semibold mb-1"><i class="fa-regular fa-comment"></i>
                            {{ $latestPost->title }}</span><br>
                    </a>
                @endforeach

            </div>
        </div>
    </div>



    <script>
        $('#loadmoreIcon').hide();

        $(document).ready(function() {




            $('#loadMoreBtn').click(function() {
                loadMorePosts();
            });

            function loadMorePosts() {
                var currentPage = parseInt($('#currentPage').val()) + 1;
                $('#loadmoreIcon').show();

                $.ajax({
                    url: '{{ route('home') }}',
                    type: 'GET',
                    data: {
                        page: currentPage
                    },
                    dataType: 'json',
                    success: function(response) {

                        var posts = response;
                        var postContainer = $('#postContainer');

                        $.each(posts, function(index, post) {
                            var postElement = $('<div>')
                                .addClass(
                                    'list-group list-group-flush border-bottom scrollarea border-primary'
                                )
                                .html(
                                    '<a href="/post/read/' + post.id +
                                    '" class="list-group-item list-group-item-action py-2 lh-sm">' +
                                    '<div class="d-flex w-100 align-items-center justify-content-between">' +
                                    '<strong class="mb-1">' + post.title + '</strong>' +
                                    '<div class="d-flex justify-content-end">' +
                                    '<div class="p-1">' +
                                    '<small class="text-muted">' + post.date + '</small>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="col-10 mb-0 small">' + post.content +
                                    '</div>' +
                                    '<div class="col-10 mb-0 small"><span class="text-primary">Category:</span> ' +
                                    post.category + '</div>' +
                                    '<div class="col-10 mb-0 small"><span class="text-success">Tags:</span> ' +
                                    post.tags.map(function(tag) {
                                        return '<i class="fa-solid fa-tag"></i> ' + tag
                                            .title;
                                    }).join('') +
                                    '</div>' +
                                    '</a>'
                                );

                            postContainer.append(postElement);

                        });

                        $('#currentPage').val(currentPage);
                        $('#loadmoreIcon').hide();

                        if (!response.next_page_url) {
                            $('#loadMoreBtn').hide();
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
    </script>
@endsection
