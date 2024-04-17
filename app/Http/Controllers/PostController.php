<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('posts.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        $comments = $post->comments()->paginate(5);
        $tagNames = $post->tags->pluck('tagName')->toArray();
        return view('posts.show', ['post' => $post, 'comments' => $comments, 'tagNames' => $tagNames]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            session()->flash('error', 'You must be logged in to access this page.');
            return redirect()->route('login');
        }


        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:3000',
            'post_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($request->hasFile('post_pic')) {
            $request->validate([
                'post_pic' => 'image|dimensions:max_width=2000,max_height=2000',
            ]);

            $imagePath = $request->file('post_pic')->store('post_pics', 'public');
            $imageUrl = asset('storage/' . $imagePath);
        } else {
            $imageUrl = null;
        }

        $post = new Post;
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->user_id = Auth::id();
        $post->post_pic = $imageUrl;
        $post->save();

        $tagNames = $request->input('tags');

        if ($tagNames) {
            if (is_string($tagNames)) {
                $tagNames = explode(',', $tagNames);
            }

            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['tagName' => trim($tagName)]);
                $post->tags()->attach($tag->id);
            }
        }

        return redirect()->route('posts.index')->with('message', 'Post was created.');
    }


    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:3000',
            'post_pic' => 'image|mimes:jpeg,png,jpg,gif|dimensions:max_width=2000,max_height=2000|max:2048',
        ]);

        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];

        if ($request->hasFile('post_pic')) {
            $imagePath = $request->file('post_pic')->store('post_pics', 'public');
            $post->post_pic = asset('storage/' . $imagePath);
        }

        $post->save();

        return redirect()->route('posts.show', ['post' => $post->id])->with('message', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        $post->delete();

        return redirect()->route('posts.index')->with('message', 'Post deleted successfully.');
    }
}
