<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Livewire\Logout;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('logout', Logout::class);
    }
}
