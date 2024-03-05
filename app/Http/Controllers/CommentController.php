<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Posts;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('comment.index', compact('comment'));
    }

    public function show(Comment $comment)
    {
        return view('comment.show', compact('comment'));
    }

    public function store(Request $request, Posts $post)
    {
        $request->validate([
            'comment_text' => 'required',
            'comment_pic' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $path = ''; // Initialize path as empty string
        $filename = '';// Initialize filename as empty string

        if ($request->hasFile('comment_pic')) { // Check if file is uploaded
            $file = $request->file('comment_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/comment/';
            $file->move($path, $filename);
        }

        // Create post with both possibilities for 'post_pic'
        Comment::create([
            'comment_text' => $request->comment_text,
            'comment_pic' => ($filename) ? $path . $filename : null, // Use ternary operator
            'posts_id' => $post->id,
            'users_id' => auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Comment posted successfully');
    }

    public function edit(Comment $comment)
    {
        return view('comment.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'comment_text' => 'required',
            'comment_pic' => 'image|mimes:jpeg,png,jpg',
        ]);
    
        // Update comment text
        $comment->comment_text = $request->comment_text;
    
        // Handle image update
        if ($request->hasFile('comment_pic')) {
            $file = $request->file('comment_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/comment/';
            $file->move($path, $filename);
            $comment->comment_pic = $path . $filename;
        }
    
        $comment->save();
    
        return redirect()->route('comment.edit', ['comment' => $comment->id])->with('status', 'Comment updated successfully');

    }
    

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}
