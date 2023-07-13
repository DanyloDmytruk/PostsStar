@extends('layouts.main')


@section ('main_content')

<div class="alert alert-danger" role="alert">
    Dear {{ auth()->user()->name }}, you're banned from PostsStar by administrator.
</div>

@endsection