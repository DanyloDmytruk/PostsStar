@extends('layouts.main')

@section('main_content')

@inject('service', 'App\Services\Posts\Service')
    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 89em;">

        <div class="list-group list-group-flush border-bottom scrollarea">
            
            @foreach ($allPosts as $post)
            
                <a href="{{route('posts.read', ['id' => $post->id])}}" class="list-group-item list-group-item-action py-2 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">{{ $post->title }}</strong>
                        <small class="text-muted">{{date("H:i j/n/Y", strtotime($post->created_at))}}</small>
                    </div>
                    <div class="col-10 mb-0 small">{{ Str::length($post->content) > 60 ? $service->trim_post_content_for_list(80, $post->content).'...' : $post->content }}</div>
                    <div class="col-10 mb-0 small"><span class="text-primary">Category:</span> {{ $post->category->title }}</div>
                    <div class="col-10 mb-0 small"><span class="text-success">Tags:</span> 
                        @foreach ($post->tags as $tag)
                        <i class="fa-solid fa-tag"></i> {{$tag->title}}
                            
                        @endforeach
                    </div>
                </a>
                
            @endforeach
                <br>
            {{$allPosts->links()}}
           

        </div>
    @endsection
