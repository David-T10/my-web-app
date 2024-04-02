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

    public function show(Post $post)
    {
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
            $imagePath = $request->file('post_pic')->store('post_pics'); 
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
    
        return redirect()->route('posts.index')->with('message', 'Post was created.');
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
    public function destroy(Post $post)
{

    $post->delete();

    return redirect()->route('posts.index')->with('message', 'Post deleted successfully.');
}

}
