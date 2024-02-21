@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<ul>
    <li>Name: {{$user->name}}</li>
    <li>Bio: {{$user->bio ?? 'No Bio'}}</li>
    <li>Date of Birth: {{$user->date_of_birth ?? 'No DOB'}}</li>
    <li>Email: {{$user->email}}</li>
    <li>Picture: 
        @if ($user->profile_pic)
            <img src="{{$user->profile_pic}}" alt="User Profile Picture"></li>
        @else
            No Picture Posted
        @endif
</ul>
@endsection