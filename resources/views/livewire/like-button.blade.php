<div>
    <button wire:click="like" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Like
    </button>
    <span>{{ $post->likes }}</span>
</div>
