<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;

class EditComment extends Component
{
    public $commentId;
    public $editCommentId;
    public $editCommentContent;

    public function mount($commentId)
    {
        $this->commentId = $commentId;
    }

    public function editComment($commentId)
    {
        $this->editCommentId = $commentId;
        $this->editCommentContent = Comment::find($commentId)->content;
    }

    public function updateComment()
    {
        $validatedData = $this->validate([
            'editCommentContent' => 'required',
        ]);

        $comment = Comment::find($this->editCommentId);
        $comment->content = $this->editCommentContent;
        $comment->save();

        $this->reset(['editCommentId', 'editCommentContent']);
        return redirect()->route('posts.show', ['post' => $comment->post_id]);
    }

    public function cancelEdit()
    {
        $this->reset(['editCommentId', 'editCommentContent']);
    }

    public function render()
    {
        return view('livewire.edit-comment');
    }
}