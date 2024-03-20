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

    @if (Auth::check() && Auth::user()->id == $post->user_id)
    <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endif

<ul>
    <strong>Comments:</strong>
    @foreach ($post->comments as $comment)
    <li>
        <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}
    </li>
    @endforeach
</ul>
{{ $comments->links() }}


<form method="POST" action="{{ route('comments.store', ['post' => $post->id]) }}">
    @csrf
    <div>
        <label for="content">Add a Comment:</label>
        <textarea name="content" id="content" rows="3"></textarea>
    </div>
    <button type="submit">Submit Comment</button>
</form>


@endsection
