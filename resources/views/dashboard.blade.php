@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@if (Auth::check())
    <p>Logged in as: <a href="{{ route('users.show', ['id' => Auth::user()->id]) }}">{{ Auth::user()->name }}</a></p>
@endif

@livewire('navigationbar')

@endsection
