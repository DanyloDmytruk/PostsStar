@extends('layouts.main')

@section('main_content')

    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 89em;">

        <div class="list-group list-group-flush border-bottom scrollarea">
            {{$post->content}}

        </div>
@endsection
