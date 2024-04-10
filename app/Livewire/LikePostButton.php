<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostLikedNotification;

class LikePostButton extends Component
{
    public $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function like()
    {
        $this->post->likes++;
        $this->post->save();

        $postOwnerEmail = $this->post->user->email;
        Mail::to($postOwnerEmail)->send(new PostLikedNotification(auth()->user()->name, $this->post->user->name));
    
    }

    public function render()
    {
        return view('livewire.like-post-button');
    }
}
