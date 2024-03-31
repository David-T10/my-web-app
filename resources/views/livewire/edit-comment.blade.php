<div>
    @if ($editCommentId)
        <form wire:submit.prevent="updateComment">
            <textarea wire:model.defer="editCommentContent" rows="3"></textarea>
            @error('editCommentContent')
                <span>{{ $message }}</span>
            @enderror
            <button type="submit">Save</button>
            <button type="button" wire:click="cancelEdit">Cancel</button>
        </form>
    @else
        <button wire:click="editComment({{ $commentId }})">Edit</button>
    @endif
</div>