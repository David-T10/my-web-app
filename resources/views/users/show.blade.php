@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="flex flex-col items-center mt-8">
    <div class="w-32 h-32 rounded-full overflow-hidden">
        @if ($user->profile?->profile_pic)
            <img class="object-cover w-full h-full" src="{{$user->profile->profile_pic}}" alt="User Profile Picture">
        @else
            <div class="bg-gray-300 flex items-center justify-center w-full h-full text-gray-600 text-xl">No Picture</div>
        @endif
    </div>
    <div class="mt-4">
        <div class="font-bold">{{$user->name}}</div>
        <div class="text-sm text-gray-600">{{$user->email}}</div>
        <div class="bg-gray-100 rounded-md p-4 mt-2 h-auto">
            <div class="text-sm">Bio:</div>
            <div>{{$user->profile->bio ?? 'No Bio'}}</div>
        </div>
        <div class="mt-2">
            <div class="text-sm">Date of Birth:</div>
            <div>{{$user->profile->date_of_birth ?? 'No DOB'}}</div>
        </div>
    </div>
</div>
@endsection
