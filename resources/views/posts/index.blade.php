@extends('layouts.app')

@section('title', 'Posts')
@section('content')

<p>All Posts from Users - Titles</p>

@if (Auth::check())
    <p>Logged in as: <a href="{{ route('users.show', ['id' => Auth::user()->id]) }}">{{ Auth::user()->name }}</a></p>
@endif

<ul>
    @foreach ($posts as $post)
    {{-- {{ dd($post->id) }} --}}
    <li><a href="{{route('posts.show',['post' => $post->id])}}">{{$post->title}}</a></li>
    @endforeach
    
</ul>
<form method="GET" action="{{ route('posts.create') }}">
    @csrf
    <button type="submit">Create Post</button>
</form>
{{$posts->links()}}
@endsection