<div>
    @if (Auth::check())
        <form wire:submit.prevent="logout">
            <button type="submit">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}">Login</a>
    @endif
</div>
