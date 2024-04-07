<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\TwitterService;
use App\Models\Post;

class TwitterButton extends Component
{
    public $postId;

    public function postTweet(TwitterService $twitter)
    {
        $post = Post::find($this->postId);

        if ($post) {
            $content = $post->content;
            $picture = $post->post_pic;
            $tags = $post->tags->pluck('tagName')->map(function ($tag) {
                return '#' . $tag;
            })->toArray();

            $twitter->postTweet($content, $picture, $tags);
        }
    }

    public function render()
    {
        return view('livewire.twitter-button');
    }
}