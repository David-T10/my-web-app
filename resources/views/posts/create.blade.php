@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-bold mb-2">Content:</label>
            <textarea name="content" id="content" rows="5" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('content') }}</textarea>
        </div>
        <div class="mb-4">
            <label for="post_pic" class="block text-gray-700 font-bold mb-2">Picture:</label>
            <input type="file" name="post_pic" id="post_pic" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-between">
            <input type="submit" value="Submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            <a href="{{ route('posts.index') }}" class="inline-block align-baseline font-bold text-sm bg-red-500 text-white-500 hover:text-red-800 rounded py-2 px-3">Cancel</a>
        </div>
    </form>
@endsection
