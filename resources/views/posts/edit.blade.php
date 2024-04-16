@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data"
            class="max-w-md mx-auto">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-bold mb-2">Content</label>
                <textarea id="content" name="content" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">{{ old('content', $post->content) }}</textarea>
            </div>
            <div class="mb-4">
                <label for="post_pic" class="block text-gray-700 font-bold mb-2">Upload Image</label>
                <input type="file" id="post_pic" name="post_pic" class="w-full">
            </div>
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md transition duration-200">Update
                Post</button>
        </form>
    </div>
@endsection
