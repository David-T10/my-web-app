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

<ul id="comments-list">
    <!-- Comments will be dynamically loaded here -->
</ul>
<button onclick="loadAllComments('{{ $post->id }}')">Show All Comments</button>

<script>
    function loadAllComments(postId) {
        // Make an Ajax request to fetch comments for the specified post ID
        fetch(`/posts/${postId}/comments`)
            .then(response => response.json())
            .then(data => {
                const commentsList = document.getElementById('comments-list');
                commentsList.innerHTML = ''; // Clear existing comments
                data.forEach(comment => {
                    commentsList.innerHTML += `<li><strong>${comment.user.name}:</strong> ${comment.content}</li>`;
                });
            })
            .catch(error => console.error('Error fetching comments:', error));
    }
</script>
@endsection
