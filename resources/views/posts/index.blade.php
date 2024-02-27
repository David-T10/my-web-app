@extends('layouts.app')

@section('title', 'Posts')
@section('content')
<p>All Posts from Users - Titles</p>
<ul>
    @foreach ($posts as $post)
    <li><a href="{{route('posts.show',['id' => $post->id])}}">{{$post->title}}</a></li>
    @endforeach
</ul>
<a href="{{route('posts.create')}}">Create Post</a>
{{$posts->links()}}
@endsection