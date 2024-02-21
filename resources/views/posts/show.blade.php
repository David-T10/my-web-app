@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
<ul>
    <li>Title: {{$post->title}}</li>
    <li>Posted By: {{$post->user->name}}</li>
    <li>Picture: 
        @if ($post->post_pic)
            <img src="{{$post->post_pic}}" alt="Post Picture"></li>
        @else
            No Picture Posted
        @endif
    <li>Content: {{$post->content}}</li>
</ul>
@endsection