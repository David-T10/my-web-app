@extends('layouts.app')

@section('title', 'Add A Comment')

@section('content')
    <form method="POST" action= "{{route('comments.store')}}">
        @csrf
        <p>Title: <input type="text" name="title" value="{{old('title')}}"></p>
        <p>Content: <input type="text" name="content" value="{{old('content')}}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>

@endsection