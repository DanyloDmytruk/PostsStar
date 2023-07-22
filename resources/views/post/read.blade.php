@extends('layouts.main')

@section('main_content')
    <div>
        <span class="badge bg-success" style="height: 12px"> </span> {{ $post->category->title }}
    </div>
    <div class="mb-1">
        <i class="fa-solid fa-tag"></i>
        @foreach ($post->tags as $tag)
            {{ $tag->title }}
        @endforeach
    </div>



    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white border-top" style="width: 89em;">

        <div class="list-group list-group-flush border-bottom scrollarea mt-2">
            <div class="container">
                <div class="row">
                    <div class="col-1">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('avatars/' . $post->author->avatar) }}" title="{{ $post->author->name }}"
                                style="border-radius: 5%; height: 5em; width: 5em">
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $post->author->name }}
                        </div>

                    </div>
                    <div class="col-11">
                        <div>
                            <img src="{{ asset('img/posts/' . $post->image) }}">
                        </div>
                        <div>
                            <p>{{ $post->content }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-between mt-2 mb-1">
                    <div class="col-2">
                        <div>
                            <i class="fa-regular fa-comments"></i> {{ count($post->comments) }} Commentaries
                        </div>
                    </div>
                    <div class="col-2 d-flex justify-content-right">
                        <div class="container">
                            <div class="row">
                                <div class="col-4">


                                    @if (in_array(auth()->user()->id, array_column($post->usersLiked->toArray(), 'id')))
                                        <input type="hidden" name="isLikedPost" value="true">
                                    @else
                                        <input type="hidden" name="isLikedPost" value="false">
                                    @endif

                                    <a>
                                        <form method="POST">
                                            @csrf
                                            <i id="like_post" class="fa-regular fa-heart"></i>
                                            <span id="postLikesCount">{{ count($post->usersLiked) }}</span>
                                        </form>
                                    </a>
                                </div>
                                <div class="col-1">
                                    <a data-toggle="modal" data-target="#linkModal">
                                        <i class="fa-solid fa-link"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4">

            <div class="row mb-2 border-bottom">
                <div class="col-1">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('avatars/' . auth()->user()->avatar) }}" title="{{ auth()->user()->name }}"
                            style="border-radius: 5%; height: 5em; width: 5em">
                    </div>

                </div>

                <div class="col-10">
                    <div class="container">
                        <div class="alert alert-danger" role="alert" id="errorData">
                            Error has occured. Check input data again.
                        </div>
                        <form id="createCommentForm" method="POST">
                            @csrf
                            <div class="row">
                                <textarea placeholder="Type your comment" rows="3" class="form-control" name="content"></textarea>
                            </div>


                            <div class="row mt-2 justify-content-end mb-1">
                                <div class="col-2">
                                    <div class="row justify-content-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa-solid fa-plus"></i> Post comment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            @foreach ($postComments as $postComment)
                <div class="row border-bottom mt-1 mb-2">
                    <div class="col-1">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('avatars/' . $postComment->author->avatar) }}"
                                title="{{ $postComment->author->name }}"
                                style="border-radius: 5%; height: 5em; width: 5em">
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $postComment->author->name }}
                        </div>

                    </div>
                    <div class="col-9">
                        <p>{{ $postComment->content }}</p>
                    </div>

                    <div class="col-2">
                        <div class="container">
                            <div class="col-12">
                                <div class="row">
                                    <div class="d-flex justify-content-end">
                                        <small
                                            class="text-muted">{{ date('H:i j/n/Y', strtotime($postComment->created_at)) }}</small>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="d-flex justify-content-end">
                                        <form method="POST">
                                            @if (in_array(auth()->user()->id, array_column($postComment->usersLiked->toArray(), 'id')))
                                                <input type="hidden" id="{{ $postComment->id }}" name="isLikedComment"
                                                    value="true">
                                            @else
                                                <input type="hidden" id="{{ $postComment->id }}" name="isLikedComment"
                                                    value="false">
                                            @endif

                                            <small class="text-muted">
                                                @if (in_array(auth()->user()->id, array_column($postComment->usersLiked->toArray(), 'id')))
                                                    <i id="{{ $postComment->id }}" name="like_comment"
                                                        class="fa-solid fa-heart"></i>
                                                @else
                                                    <i id="{{ $postComment->id }}" name="like_comment"
                                                        class="fa-regular fa-heart"></i>
                                                @endif

                                                <span id="{{ $postComment->id }}"
                                                    name="commentLikesCount">{{ $postComment->likes }}</span>
                                            </small>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Link Modal -->
        <div class="modal fade" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="linkModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="linkModalLabel"><i class="fa-solid fa-link"></i>
                            Copy link
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input readonly type="text" class="form-control" value="{{ request()->fullUrl() }}">
                            <div class="input-group-append">
                                <button onclick="copyLinkToClipboard()" class="btn btn-outline-success" type="button"><i
                                        class="fa-solid fa-copy"></i>
                                    Copy</button>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                $('#errorData').hide();

                $('#createCommentForm').submit(function(e) {
                    e.preventDefault();

                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    var formData = new FormData(this);
                    formData.append('_token', csrfToken);
                    formData.append('postid', '{{ $post->id }}');

                    $.ajax({
                        url: "{{ route('ajax.createcomment') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response == 'FAIL') {
                                $('#errorData').show();
                            } else {

                                console.log(response.message);
                                location.reload();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            $('#errorData').show();
                        }
                    });
                });

                function isClipboardAPIAvailable() {
                    return navigator.clipboard && typeof navigator.clipboard.writeText === 'function';
                }


                function copyLinkToClipboard() {
                    const textToCopy = '{{ request()->fullUrl() }}';

                    if (isClipboardAPIAvailable()) {
                        // Use Clipboard API to write the text to clipboard
                        navigator.clipboard.writeText(textToCopy);
                    } else {
                        // Fallback for browsers that don't support the Clipboard API
                        console.warn('Clipboard API is not supported in this browser.');
                    }
                }



                $('#copyButton').on('click', copyLinkToClipboard);


                if ($('input[name="isLikedPost"]').val() == 'true') {
                    $('#like_post').removeClass('fa-regular fa-heart').addClass('fa-solid fa-heart');
                }



                function likePost() {

                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    if ($('input[name="isLikedPost"]').val() == 'true') {
                        $.ajax({
                            url: "{{ route('ajax.dislikepost') }}",
                            type: "POST",
                            data: {
                                postid: '{{ $post->id }}',
                                '_token': csrfToken,
                            },
                            success: function(response) {
                                $('#postLikesCount').text(response);
                                console.log(response);
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }


                        });

                        $('#like_post').removeClass('fa-solid fa-heart').addClass('fa-regular fa-heart');
                        $('input[name="isLikedPost"]').val("false");

                    } else {

                        $.ajax({
                            url: "{{ route('ajax.likepost') }}",
                            type: "POST",
                            data: {
                                'postid': '{{ $post->id }}',
                                '_token': csrfToken,
                            },
                            success: function(response) {
                                $('#postLikesCount').text(response);
                                console.log(response);
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }

                        });

                        $('#like_post').removeClass('fa-regular fa-heart').addClass('fa-solid fa-heart');
                        $('input[name="isLikedPost"]').val("true");
                    }
                }

                $('#like_post').on('click', function(e) {
                    likePost();
                });




                $('i[name="like_comment"]').on('click', function(e) {
                    likeComment($(this).attr('id'));
                });

                function likeComment(id) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    if ($('input[name="isLikedComment"][id="' + id + '"]').val() == 'true') {
                        $.ajax({
                            url: "{{ route('ajax.dislikecomment') }}",
                            type: "POST",
                            data: {
                                commentid: id,
                                '_token': csrfToken,
                            },
                            success: function(response) {
                                $('span[name="commentLikesCount"][id="' + id + '"]').text(response);

                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }


                        });

                        $('i[name="like_comment"][id="' + id + '"]').removeClass('fa-solid fa-heart').addClass(
                            'fa-regular fa-heart');
                        $('input[name="isLikedComment"][id="' + id + '"]').val("false");

                    } else {

                        $.ajax({
                            url: "{{ route('ajax.likecomment') }}",
                            type: "POST",
                            data: {
                                commentid: id,
                                '_token': csrfToken,
                            },
                            success: function(response) {
                                $('span[name="commentLikesCount"][id="' + id + '"]').text(response);
                                console.log(response);
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }


                        });

                        $('i[name="like_comment"][id="' + id + '"]').removeClass('fa-regular fa-heart').addClass(
                            'fa-solid fa-heart');
                        $('input[name="isLikedComment"][id="' + id + '"]').val("true");
                    }
                }

            });
        </script>
    @endsection
