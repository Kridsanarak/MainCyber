<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Posts;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


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
    public function mypost()
    {
        $posts = auth()->user()->posts;
        $posts = Posts::orderBy('created_at', 'desc')->paginate(100);
        return view('posts.mypost', compact('posts'));
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
            'post_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maximum size 2MB
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
    
        // Redirect based on user role
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.home')->with('status','Posts Created Successfully');
        } else {
            return redirect()->route('home')->with('status', 'Posts Created Successfully');
        }
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

    // Check if the user is authorized to update the post
    if (!auth()->user()->isAdmin() && $posts->users_id != auth()->id()) {
        return redirect()->route('posts.data', ['id' => $posts->id])->with('status', 'คุณไม่มีสิทธิ์แก้ไขโพสต์นี้');
    }

    // Handle file upload if exists
    if ($request->hasFile('post_pic')) {
        $file = $request->file('post_pic');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $path = 'uploads/posts/';
        $file->move($path, $filename);

        // Delete old post picture
        if (File::exists($posts->post_pic)) {
            File::delete($posts->post_pic);
        }

        // Update post picture
        $posts->post_pic = $path . $filename;
    }

    // Update post details
    $posts->topic = $request->topic;
    $posts->details = $request->details;
    $posts->save();

    return redirect()->route('posts.data', ['id' => $posts->id])->with('status', 'โพสต์ได้รับการอัปเดตเรียบร้อยแล้ว');
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

    // Check if user is admin
    if (Auth::user()->isAdmin()) {
        return redirect()->route('admin.home')->with('status', 'Post Deleted');
    } else {
        return redirect()->route('home')->with('status', 'Post Deleted');
    }
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