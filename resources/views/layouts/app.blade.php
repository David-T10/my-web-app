<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog Website - @yield('title')</title>
    @livewireScripts
    @vite('resources/css/app.css')
</head>
<body class="bg-blue-400">
    <h1 class="font-bold text-3xl underline">Blog Website - @yield('title')</h1>
    
    <div class="flex justify-between items-center p-4">
        @livewire('navigationbar')
        <div></div>
        <div class="flex-initial">
            @livewire('login-logout-button')
        </div>
    </div>

    @if (session('message'))
        <p><b>{{session('message')}}</b></p>
    @endif

    @if ($errors->any())
        <div>
            Errors:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        @yield('content')
    </div>
</body>
</html>
