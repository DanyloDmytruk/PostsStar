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
                            <img src="{{ asset('avatars/' . auth()->user()->avatar) }}" title="{{ auth()->user()->name }}"
                                style="border-radius: 5%; height: 5em; width: 5em">
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $post->author->name }}
                        </div>

                    </div>
                    <div class="col-11">
                        <p>{{ $post->content }}</p>
                    </div>
                </div>

                <div class="row justify-content-between mt-2 mb-1">
                    <div class="col-2">
                        <div>
                            <i class="fa-regular fa-comments"></i> 1488 Commentaries
                        </div>
                    </div>
                    <div class="col-2 d-flex justify-content-right">
                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                    <a>
                                        <i class="fa-regular fa-heart"></i> 11
                                    </a>
                                </div>
                                <div class="col-1">
                                    <a>
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

                    </div>
                </div>
            </div>



            <div class="row border-bottom mt-1 mb-2">
                <div class="col-1">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('avatars/' . auth()->user()->avatar) }}" title="{{ auth()->user()->name }}"
                            style="border-radius: 5%; height: 5em; width: 5em">
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $post->author->name }}
                    </div>

                </div>
                <div class="col-11">
                    <p>Nice article!</p>
                </div>
            </div>

            <div class="row border-bottom mt-4 mb-2">
                <div class="col-1">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('avatars/' . auth()->user()->avatar) }}" title="{{ auth()->user()->name }}"
                            style="border-radius: 5%; height: 5em; width: 5em">
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $post->author->name }}
                    </div>

                </div>
                <div class="col-11">
                    <p>Nice article!</p>
                </div>
            </div>

        </div>
    @endsection
