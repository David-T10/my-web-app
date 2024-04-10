<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class LikeButton extends Component
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
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
