@extends('layouts.app')

@section('title', 'All Posts')

@section('content')

    <div class="mt-8">
        <ul>
            @foreach ($posts as $post)
                <li>
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}"
                       class="block py-2 px-4 bg-white hover:bg-gray-200 transition duration-200 rounded-md">{{ $post->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="mt-8">
        <form method="GET" action="{{ route('posts.create') }}">
            @csrf
            <button type="submit" class="bg-yellow-500 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded-md transition duration-200">Create Post</button>
        </form>
    </div>

    {{ $posts->links() }}
@endsection
