<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog Website - @yield('title')</title>
    @livewireScripts
    @vite('resources/css/app.css')
</head>
<body class="bg-blue-400">
    <h1>Blog Website - @yield('title')</h1>
    
    @livewire('login-logout-button')

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