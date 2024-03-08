<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Posts;
use App\Models\Comment;

class PostsController extends Controller
{
    // Create Index
    public function index()
    {
        // Get all posts sorted by latest
        $posts = Posts::latest()->get();
        return view('posts.index', compact('posts'));   
    }

    public function postsData($id)
    {
        $posts = Posts::find($id);
        return view('posts.data', compact('posts'));
    }

    // PostController.php
    public function userpost()
    {
        $posts = auth()->user()->posts;
        $posts = Posts::orderBy('created_at', 'desc')->paginate(100);
        return view('posts.userpost', compact('posts'));
    }

    // Create Post
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'topic' => 'required|max:100|string',
            'details' => 'required',
            'post_pic' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        // Initialize variables
        $path = ''; // Initialize path as empty string
        $filename = ''; // Initialize filename as empty string

        if($request->hasFile('post_pic')){
            // Handle file upload
            $file = $request->file('post_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = 'uploads/posts/';
            $file->move($path, $filename);
        }

        // Create new post
        Posts::create([
            'topic' => $request->topic,
            'details' => $request->details,
            'post_pic' => $path.$filename,
            'users_id' => auth()->user()->id,
            'users_name' => auth()->user()->name,
        ]);

        return redirect()->route('home')->with('status','Posts Created Successfully');
    }

    public function edit(int $id)
    {
        // Find post by ID
        $posts = Posts::findOrFail($id);
        return view('posts.edit', compact('posts'));
    }

    public function update(Request $request, int $id)
    {
        // Validate request data
        $request->validate([
            'topic' => 'required|max:100|string',
            'details' => 'required',
            'post_pic' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);
    
        // Find post by ID
        $posts = Posts::findOrFail($id);
    
        if($request->hasFile('post_pic')){
            // Handle file upload
            $file = $request->file('post_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = 'uploads/posts/';
            $file->move($path, $filename);
    
            // Delete old post picture
            if(File::exists($posts->post_pic)){
                File::delete($posts->post_pic);
            }
        }
        
        // Update post
        $posts->update([
            'topic' => $request->topic,
            'details' => $request->details,
        ]);

        // Prepare update data
        $updateData = [
            'topic' => $request->topic,
            'details' => $request->details,
        ];
    
        // Update post picture if exists
        if(isset($filename)){
            $updateData['post_pic'] = $path.$filename;
        }
    
        $posts->update($updateData);
        
        
        return redirect()->route('posts.data', ['id' => $posts->id])->with('status','Post Updated');
    }

    public function destroy(int $id)
    {
        // Find post by ID
        $posts = Posts::findOrFail($id);
        
        // Delete post picture if exists
        if(File::exists($posts->post_pic)){
            File::delete($posts->post_pic);
        }

        // Delete post
        $posts->delete();

        return redirect()->route('home')->with('status', 'Post Deleted');
    }

    public function comment(Posts $post)
    {
        // Get comments of specified post
        $comments = $post->comments;
        return view('posts.comment', compact('comments'));
    }

    public function search()
    {
        // Get search query from request
        $search_text = $_GET['query'];
        
        // Search posts by topic or users_name
        $posts = Posts::where('topic', 'LIKE', '%' . $search_text . '%')
              ->orWhere('users_name', 'LIKE', '%' . $search_text . '%')
              ->get();

        return view('posts.search',compact('posts'));
    }

    public function searchUser()
    {
        // Get search query from request
        $search_text = $_GET['query'];
        
        // Search posts by topic or users_name
        $posts = Posts::where('topic', 'LIKE', '%' . $search_text . '%')
              ->orWhere('users_name', 'LIKE', '%' . $search_text . '%')
              ->get();

        return view('posts.index',compact('posts'));
    }

    public function searchNormal()
    {
        // Get search query from request
        $search_text = $_GET['query'];
        
        // Search posts by topic or users_name
        $posts = Posts::where('topic', 'LIKE', '%' . $search_text . '%')
              ->orWhere('users_name', 'LIKE', '%' . $search_text . '%')
              ->get();

        return view('posts.searchwelcom',compact('posts'));
    }

}