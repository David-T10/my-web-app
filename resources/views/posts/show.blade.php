@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
<ul>
    <li>Title: {{$post->title}}</li>
    <li>Posted By: <a href="{{route('users.show',['id' => $post->user->id])}}">{{$post->user->name}}</a></li>
    <li>Picture: 
        @if ($post->post_pic)
            <img src="{{$post->post_pic}}" alt="Post Picture"></li>
        @else
            No Picture Posted
        @endif
    <li>Content: {{$post->content}}</li>
</ul>
@endsection