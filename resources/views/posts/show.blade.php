@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
    <div class="mt-8">
        <h2 class="underline font-bold">{{ $post->title }}</h2>
        @if (Auth::check() && (Auth::user()->id == $post->user_id || (Auth::user()->roles && Auth::user()->roles()->where('name', 'admin')->exists())))
            <form class="inline-block" method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-3 rounded-md transition duration-200">Delete</button>
            </form>
        @endif
    </div>

    <div class="mt-4">
        <p class = "font-bold underline hover:text-white">Author: <a href="{{ route('users.show',['id' => $post->user->id]) }}">{{ $post->user->name }}</a></p>
        <p>
            @if ($post->post_pic)
                <img src="{{ storage_path($post->post_pic) }}" alt="Post Picture">
            @else
                No Picture Posted
            @endif
        </p>
    </div>

    <div class="bg-gray-200 mt-4 p-4">
        <p>Caption: {{ $post->content }}</p>
    </div>

    <div class="mt-8">
        <ul class="bg-gray-300 p-4 rounded-md">
            <strong>Comments:</strong>
            @foreach ($post->comments as $comment)
                <li class="mt-4">
                    <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}
                    @if (Auth::check() && (Auth::user()->id == $comment->user_id || (Auth::user()->roles && Auth::user()->roles()->where('name', 'admin')->exists())))
                        @livewire('edit-comment', ['commentId' => $comment->id])
                        <form class="inline-block" method="POST" action="{{ route('comments.destroy', ['comment' => $comment->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-gray-800 font-bold py-1 px-2 text-sm rounded-md transition duration-200">Delete</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    {{ $comments->links() }}

    <div class="mt-8">
        <form method="POST" action="{{ route('comments.store', ['post' => $post->id]) }}">
            @csrf
            <div class="mt-4">
                <label for="content">Add a Comment:</label>
                <textarea name="content" id="content" rows="3" class="block w-full rounded-md"></textarea>
            </div>
            <button type="submit" class="mt-4 bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded-md transition duration-200">Submit Comment</button>
        </form>
    </div>
@endsection
