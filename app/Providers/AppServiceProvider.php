<?php

namespace App\Providers;

use App\Http\Livewire\Likebutton;
use Illuminate\Support\ServiceProvider;
use App\Http\Livewire\LoginLogoutButton;
use App\Http\Livewire\TwitterButton;
use App\Services\TwitterService;
use Livewire\Livewire;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(TwitterService::class, function ($app) {
            return new TwitterService(new Client());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('login-logout-button', LoginLogoutButton::class);
        Livewire::component('twitter-button', TwitterButton::class);
        Livewire::component('like-button', LikeButton::class);
    }
}
