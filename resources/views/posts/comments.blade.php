@extends('layouts.app')

@section('title', 'User Details')

@section('content')

<ul>
    @foreach ($post->comments as $comment)
    <li>
        <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}
    </li>
    @endforeach
</ul>

@endsection