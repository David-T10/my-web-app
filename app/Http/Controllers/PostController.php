<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view ('posts.index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments()->paginate(5);
        return view ('posts.show', ['post'=> $post, 'comments' => $comments]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()){
            session()->flash('error', 'You must be logged in to access this page.');
            return redirect()->route('login');
        }
        $validatedData = $request->validate([
            'title'=> 'required|max:255',
            'content' => 'required|max:3000'
        ]);
        
        $p = new Post;
        $p->title = $validatedData['title'];
        $p->content = $validatedData['content'];
        $p->user_id = Auth::id();
        $p->save();

        return redirect()->back()->with('message','Post was created.');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post_id)
{
    if (Auth::id() !== $post_id->user_id) {
        // User is not the owner of the post
        return redirect()->back()->with('error', 'You are not authorized to delete this post.');
    }

    $post = Post::findOrFail($post_id);
    $post->delete();

    return redirect()->back()->with('message', 'Post deleted successfully.');
}

}
