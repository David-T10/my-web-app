@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
<ul>
    <li>Title: {{ $post->title }}</li>
    <li>Posted By: <a href="{{ route('users.show',['id' => $post->user->id]) }}">{{ $post->user->name }}</a></li>
    <li>Picture: 
        @if ($post->post_pic)
            <img src="{{ $post->post_pic }}" alt="Post Picture">
        @else
            No Picture Posted
        @endif
    </li>
    <li>Content: {{ $post->content }}</li>
    </ul>

<ul>
    <strong>Comments:</strong>
    @foreach ($post->comments as $comment)
    <li>
        <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}
    </li>
    @endforeach
</ul>
{{ $comments->links() }}


@endsection