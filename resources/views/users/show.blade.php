@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="flex flex-col items-center mt-8">
    <div class="w-32 h-32 rounded-full overflow-hidden">
        @if ($user->profile?->profile_pic)
            <img class="object-cover w-full h-full" src="{{$user->profile->profile_pic}}" alt="User Profile Picture">
        @else
            <div class="bg-gray-300 flex items-center justify-center w-full h-full text-gray-600 text-xl">No Picture</div>
        @endif
    </div>
    <div class="mt-4">
        <div class="font-bold">{{$user->name}}</div>
        <div class="text-sm text-gray-600">{{$user->email}}</div>
        <div class="bg-gray-100 rounded-md p-4 mt-2 h-auto">
            <div class="text-sm">Bio:</div>
            <div>{{$user->profile->bio ?? 'No Bio'}}</div>
        </div>
        <div class="mt-2">
            <div class="text-sm">Date of Birth:</div>
            <div>{{$user->profile->date_of_birth ?? 'No DOB'}}</div>
        </div>
    </div>
</div>

<div class="mt-8">
    <h2 class="text-xl font-bold">Posts Created by {{$user->name}}</h2>
    @if($user->posts->count() > 0)
        <ul class="mt-4">
            @foreach($user->posts as $post)
                <li class="flex items-center justify-between bg-white rounded-lg shadow-md p-4 mb-4">
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="text-blue-500 hover:underline">{{ $post->title }}</a>
                    @if (Auth::check() &&
                        (Auth::user()->id == $post->user_id ||
                        (Auth::user()->roles && Auth::user()->roles()->where('name', 'admin')->exists())))
                        <form class="inline-block" method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md transition duration-200">Delete</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p>No posts created by {{$user->name}}</p>
    @endif
</div>

<div class="mt-8">
    <h2 class="text-xl font-bold">Comments by {{$user->name}}</h2>
    @if($user->comments->count() > 0)
        <ul class="mt-4">
            @foreach($user->comments as $comment)
                <li class="bg-white rounded-lg shadow-md p-4 mb-4">
                    <p>{{$comment->content}}</p>
                    @if (Auth::check() &&
                        (Auth::user()->id == $comment->user_id ||
                        (Auth::user()->roles && Auth::user()->roles()->where('name', 'admin')->exists())))
                        @livewire('edit-comment', ['commentId' => $comment->id])
                        <form class="inline-block" method="POST" action="{{ route('comments.destroy', ['comment' => $comment->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md transition duration-200">Delete</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p>No comments by {{$user->name}}</p>
    @endif
</div>

@endsection
