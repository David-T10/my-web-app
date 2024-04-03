<div class="container mx-auto mt-5">
    <div class="flex justify-center space-x-4">
        <a href="{{ route('posts.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg">View All Posts</a>
        <a href="{{ route('users.show', ['id' => Auth::id()]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg">View Profile</a>
        <a href="{{ route('posts.create') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-3 px-6 rounded-lg">Create Post</a>
    </div>
</div>