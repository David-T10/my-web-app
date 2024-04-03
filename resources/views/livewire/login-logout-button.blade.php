<div>
    @vite('resources/css/app.css')
    @if (Auth::check())
    <p>Logged in as: <a class="hover:text-white" href="{{ route('users.show', ['id' => Auth::user()->id]) }}">{{ Auth::user()->name }}</a></p>
@endif
    @if (Auth::check())
        <form wire:submit.prevent="logout">
            <button type="submit" class="bg-white hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                Logout
            </button>
        </form>
    @else
        <a href="{{ route('login') }}" class="bg-white hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">Login</a>
    @endif
</div>
