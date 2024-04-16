@extends('layouts.app')

@section('title', 'Post Details')

@section('content')

    <div class="relative">
        <div class="absolute top-0 right-0 mt-4 mr-4">
            @livewire('twitter-button', ['postId' => $post->id])
        </div>

        <div class="mt-8">
            <h2 class="underline font-bold">{{ $post->title }}</h2>
            @if (Auth::check() &&
                    (Auth::user()->id == $post->user_id ||
                        (Auth::user()->roles && Auth::user()->roles()->where('name', 'admin')->exists())))
                <form class="inline-block" method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-3 rounded-md transition duration-200">Delete</button>
                </form>
            @endif
        </div>

        <div class="mt-4">
            <p class="font-bold underline hover:text-white">Author: <a
                    href="{{ route('users.show', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a></p>
            <p>
                @if ($post->post_pic)
                    <img src="{{ asset($post->post_pic) }}" alt="Post Picture">
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
                    <span
                        class="inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $tagName }}</span>
                @endforeach
            @else
                <p>No tags</p>
            @endif

            @livewire('like-post-button', ['post' => $post])

        </div>

        <div class="mt-8">
            <ul class="bg-gray-300 p-4 rounded-md">
                <strong>Comments:</strong>
                @foreach ($post->comments as $comment)
                    <li class="mt-4">
                        <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}
                        @if (Auth::check() &&
                                (Auth::user()->id == $comment->user_id ||
                                    (Auth::user()->roles && Auth::user()->roles()->where('name', 'admin')->exists())))
                            @livewire('edit-comment', ['commentId' => $comment->id])
                            <form class="inline-block" method="POST"
                                action="{{ route('comments.destroy', ['comment' => $comment->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-gray-800 font-bold py-1 px-2 text-sm rounded-md transition duration-200">Delete</button>
                            </form>
                        @elseif (Auth::check() && Auth::user()->id == $post->user_id)
                            <form class="inline-block" method="POST"
                                action="{{ route('comments.destroy', ['comment' => $comment->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-gray-800 font-bold py-1 px-2 text-sm rounded-md transition duration-200">Delete</button>
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
                <button id="submit-comment" type="button"
                    class="mt-4 bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded-md transition duration-200">Submit
                    Comment</button>
            </form>
        </div>

        <script>
            document.getElementById('submit-comment').addEventListener('click', function() {
                let content = document.getElementById('comment-content').value;
                let postId = '{{ $post->id }}';

                fetch('{{ route('comments.store', ['post' => $post->id]) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            content: content,
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
                        console.log(data);
                        let commentHtml = `
                            <li class="mt-4">
                                <strong>${data.user.name}:</strong> ${data.content}
                        `;

                        @if (Auth::check())
                            @if (Auth::user()->id == $post->user_id ||
                                    Auth::user()->id == '${data.user.id}' ||
                                    (Auth::user()->roles && Auth::user()->roles()->where('name', 'admin')->exists()))
                                commentHtml += `
                                    @livewire('edit-comment', ['commentId' => '${data.commentId}'])
                                    <form class="inline-block" method="POST"
                                        action="{{ route('comments.destroy', ['comment' => 'COMMENT_ID']) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-gray-800 font-bold py-1 px-2 text-sm rounded-md transition duration-200">Delete</button>
                                    </form>
                                `.replace('COMMENT_ID', data.commentId);
                            @endif
                        @endif
                        commentHtml += `</li>`;

                        document.querySelector('.bg-gray-300').insertAdjacentHTML('beforeend', commentHtml);
                        document.getElementById('comment-content').value = '';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        </script>

    @endsection
