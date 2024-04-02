@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    
@if (Auth::check())
        <p>Logged in as: <a href="{{ route('users.show', ['id' => Auth::user()->id]) }}">{{ Auth::user()->name }}</a></p>
    @endif

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <a href="{{ route('posts.index') }}" class="btn btn-primary btn-lg btn-block mb-3">View All Posts</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('users.show', ['id' => Auth::id()]) }}" class="btn btn-success btn-lg btn-block mb-3">View Profile</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('posts.create') }}" class="btn btn-warning btn-lg btn-block mb-3">Create Post</a>
            </div>
        </div>
    </div>
    



@endsection