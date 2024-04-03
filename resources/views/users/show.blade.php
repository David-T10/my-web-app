@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<ul>
    <li>Name: {{$user->name}}</li>
    <li>Email: {{$user->email}}</li>
    <li>Bio: {{$user->profile->bio ?? 'No Bio'}}</li>
    <li>Date of Birth: {{$user->profile->date_of_birth ?? 'No DOB'}}</li>
    <li>Picture: 
        @if ($user->profile->profile_pic)
            <img src="{{$user->profile->profile_pic}}" alt="User Profile Picture"></li>
        @else
            No Picture Posted
        @endif
</ul>
@endsection
