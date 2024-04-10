<div>
    <button wire:click="like"
            class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Like Post
    </button>
    <span>{{ $post->likes }}</span>
</div>
