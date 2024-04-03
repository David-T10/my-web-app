<div>
    @if ($editCommentId)
        <form wire:submit.prevent="updateComment">
            <textarea wire:model.defer="editCommentContent" rows="3"></textarea>
            @error('editCommentContent')
                <span>{{ $message }}</span>
            @enderror
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded-md text-sm transition duration-200">Save</button>
            <button type="button" wire:click="cancelEdit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-3 rounded-md text-sm transition duration-200 ml-2">Cancel</button>
        </form>
    @else
        <button wire:click="editComment({{ $commentId }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-md text-sm transition duration-200">Edit</button>
    @endif
</div>
