@extends('layouts.app')

@section('title', 'Post Details')

@section('content')

<div class="relative">
    <div class="absolute top-0 right-0 mt-4 mr-4">
        @livewire('twitter-button', ['postId' => $post->id])
    </div>

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

    <div class="mt-4">
        @if (!empty($tagNames))
            <strong>Tags:</strong>
            @foreach ($tagNames as $tagName)
                <span class="inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $tagName }}</span>
            @endforeach
        @else
            <p>No tags</p>
        @endif

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

    <div id="comment-form" class="mt-8">
        <form>
            @csrf
            <div class="mt-4">
                <label for="comment-content">Add a Comment:</label>
                <textarea id="comment-content" rows="3" class="block w-full rounded-md"></textarea>
            </div>
            <button id="submit-comment" type="button" class="mt-4 bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded-md transition duration-200">Submit Comment</button>
        </form>
    </div>

    <script>
        document.getElementById('submit-comment').addEventListener('click', function() {
            let comment = document.getElementById('comment-content').value;
            let postId = '{{ $post->id }}';

            fetch('{{ route('comments.store', ['post' => $post->id]) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    comment: comment,
                    post_id: postId
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Handle success response
                console.log(data); // Log the response for debugging

                // Add the new comment to the comments section
                let commentHtml = `
                    <li class="mt-4">
                        <strong>${data.user.name}:</strong> ${data.comment}
                        <!-- Add edit and delete buttons if needed -->
                    </li>
                `;
                document.querySelector('.bg-gray-300').insertAdjacentHTML('beforeend', commentHtml);

                // Clear the comment input field
                document.getElementById('comment-content').value = '';
            })
            .catch(error => {
                // Handle error
                console.error('Error:', error);
            });
        });
    </script>
@endsection
