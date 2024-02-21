<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class CommentController extends Controller
{
    public function index($postId){
        try{
        $post = Post::findOrFail($postId);
        $comments = $post->comments;
        return response()->json($comments);
        }  catch(\Exception $e){
            return response()->json(["error"=> $e->getMessage()], 500);
        }
    }
}
