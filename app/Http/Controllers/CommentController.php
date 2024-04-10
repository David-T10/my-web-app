<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view ('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $post_id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in to add a comment.'], 403);
        }
    
        $request->validate([
            'content' => 'required|max:500',
        ]);
    
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = Auth::id();
        $comment->post_id = $post_id;
        $comment->save();
    
        return response()->json([
            'content' => $comment->content,
            'user' => $comment->user,
            'userId' => $comment->user_id,
            'commentId' => $comment->id, // Include the comment ID in the response
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

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
    public function destroy(Comment $comment)
    {
        $postId = $comment->post_id;
        $comment->delete();
    
        return redirect()->route('posts.show', ['post' => $postId])->with('message', 'Comment deleted successfully.');
    }
}
