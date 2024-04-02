<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\TwitterService;

class TwitterButton extends Component
{
    public function postTweet(TwitterService $twitter)
    {
        $tweet = 'This is my tweet!'; // Get the tweet content from user input
        $twitter->postTweet($tweet);
    }

    public function render()
    {
        return view('livewire.twitter-button');
    }
}
