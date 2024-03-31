<div>
    @if (Auth::check())
        <form wire:submit.prevent="logout">
            <button type="submit">Logout</button>
        </form>
    @endif
</div>
