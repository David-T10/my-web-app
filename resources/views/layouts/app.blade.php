<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Blog Website - @yield('title')</title>
    </head>
    <body>
        <h1>Blog Website - @yield('title')</h1>
        @livewire('Logout')
        @if (session('message'))
            <p><b>{{session('message')}}</b></p>
        @endif
        @if ($errors->any())
        <div>
            Errors:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
        <div>
            @yield('content')
        </div>
    </body>
</html>
