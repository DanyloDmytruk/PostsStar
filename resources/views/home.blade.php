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

            <div class="container border-bottom" style="padding-bottom: 1em">
                <div class="row justify-content-md-left mb-1">
                    <button onclick="location.href='{{ route('posts.create') }}'" type="button" class="btn btn-primary"><i
                            class="fa-solid fa-circle-plus"></i> Create New
                        Post</button>
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
                                            <small class="text-muted">
                                                <i id="{{ $userPost->id }}" style="color: #d59319"
                                                    class="fa-solid fa-pencil update-post"></i>
                                                <i onclick="DeletePostModalForm('{{ $userPost->id }}')"
                                                    class="fa-solid fa-trash delete-post" data-toggle="modal"
                                                    data-target="#deletePostModal" style="color: #ee1515"></i>
                                            </small>
                                        </div>
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
                <div>
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
                </div>

            </div>
        </div>
    </div>




    <!-- Change Profile Photo Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal content goes here -->
                <form id="photoForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><i class="fa-solid fa-image"></i> Change Profile Photo
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input id="changeAvatar" type="file" class="form-control" name="changeAvatar"
                            value="{{ old('avatar') }}" required>

                        <span id="errUploadAvatar" class="invalid-feedback" role="alert">
                            <strong>Error uploading Photo</strong>
                        </span>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload Photo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Delete Modal -->
    <div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-labelledby="deletePostLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal content goes here -->
                <form id="deleteForm">
                    <div class="modal-header">
                        <h4 class="modal-title" id="deletePostLabel"><i class="fa-solid fa-trash delete-post"></i> Are
                            you sure want
                            to delete this post?
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" id="yesDelete" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#errUploadAvatar').hide();
        $('#loadmoreIcon').hide();

        $(document).ready(function() {

            $('.list-group-item').on('click', function(e) {
                if ($(e.target).hasClass('delete-post')) {
                    e.preventDefault();
                    // Open deletePostModal
                    $('#deletePostModal').modal('show');
                }
            });

            $('.list-group-item').on('click', function(e) {
                if ($(e.target).hasClass('update-post')) {
                    e.preventDefault();
                    location.href = "/post/update/" + $(e.target).attr('id');
                }
            });

            $('#deletePostModal').on('hidden.bs.modal', function() {
                $('.modal-backdrop').remove(); // Remove the modal overlay
                location.reload();
            });


            $("#bio").change(function() {
                var value = $(this).val();

                $.post("{{ route('ajax.changebio') }}", {
                    "_token": "{{ csrf_token() }}",
                    method: 'changebio',
                    bio: value,
                });
            });

            $('#photoForm').submit(function(e) {
                e.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var formData = new FormData(this);
                formData.append('_token', csrfToken);

                $.ajax({
                    url: "{{ route('ajax.changeavatar') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response.message);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log("Error: " + xhr.responseText);
                        $('#errUploadAvatar').show();


                        $('#changeAvatar').addClass('is-invalid');
                    }
                });
            });


        });


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
                                'list-group list-group-flush border-bottom scrollarea border-primary')
                            .html(
                                '<a href="/post/read/' + post.id +
                                '" class="list-group-item list-group-item-action py-2 lh-sm">' +
                                '<div class="d-flex w-100 align-items-center justify-content-between">' +
                                '<strong class="mb-1">' + post.title + '</strong>' +
                                '<div class="d-flex justify-content-end">' +
                                '<div class="p-1">' +
                                '<small class="text-muted"><i id="' + post.id +
                                '" style="color: #d59319" class="fa-solid fa-pencil update-post"></i> <i class="fa-solid fa-trash delete-post" data-toggle="modal" data-target="#deletePostModal" style="color: #ee1515"></i></small>' +
                                '</div>' +
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
                                    return '<i class="fa-solid fa-tag"></i> ' + tag.title;
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



        function DeletePostModalForm(id) {
            $('#yesDelete').attr('onclick', 'DeletePost(' + id + ')');
        }


        function DeletePost(id) {
            $.ajax({
                url: '{{ route('ajax.deletepost') }}',
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    location.reload();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
