@extends('layouts.memberapp')
@section('content')
<main class="container">
    <div class="card mb-4">
        <div class="card-body">
            <h4>
                @guest
                <a href="{{ route('welcome') }}" class="btn btn-primary float-end">Back</a>
                @endguest
                @auth
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.home') }}" class="btn btn-primary float-end">Back to Admin Home</a>
                @else
                <a href="{{ route('home') }}" class="btn btn-primary float-end">Back</a>
                @endif
                @endauth
            </h4>
            <h3 class="card-title">{{ $posts->topic }}</h3>
            <p class="card-text">Posted by: {{ $posts->users_name }} • {{ $posts->created_at }}</p>
            <p class="card-text">{{ $posts->details }}</p>
            @if($posts->post_pic)
            <img class="img-fluid mb-3" src="{{ asset($posts->post_pic) }}" alt="Post Image">
            @endif

            <!-- edit/delete post -->
            @if(auth()->check() && (auth()->user()->id === $posts->users_id || auth()->user()->isAdmin()))
            <div class="mb-3">
                <a href="{{ url('posts/'.$posts->id.'/edit') }}" class="btn btn-sm btn-warning">Edit Post</a>
                <form action="{{ url('posts/'.$posts->id.'/delete') }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post and its comments?')">Delete Post</button>
                </form>
            </div>
            @endif
            <!-- end -->


        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('comment.store', ['post' => $posts->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="post_id" value="{{ $posts->id }}">
                <div class="mb-3">
                    <label for="comment_text" class="form-label">Comment</label>
                    <textarea class="form-control" id="comment_text" name="comment_text" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="comment_pic" class="form-label">Image</label>
                    <input type="file" class="form-control" id="comment_pic" name="comment_pic">
                </div>
                @auth
                <!-- Check if user is authenticated -->
                <button type="submit" class="btn btn-primary">Submit</button>
                @else
                <p>&nbspYou must <a href="{{ route('login') }}">login</a> to submit a comment.</p>
                @endauth
            </form>

        </div>
    </div>
    @foreach ($posts->comments as $comment)
    <div class="card mb-3">
        <div class="card-body">
            <p>Comment by: {{ $comment->user->name }} • {{ $comment->created_at }}</p>
            <h5 class="card-text">{{ $comment->comment_text }}</h5>
            @if ($comment->comment_pic)
            <img style="float: left; max-width: 300px; max-height: 300px; margin-right: 10px;"
                src="{{ asset($comment->comment_pic) }}" alt="Comment Image">
            @endif

            <!-- edit/delete comment -->
            @if(auth()->check() && (auth()->user()->id === $comment->users_id || auth()->user()->isAdmin()))
            <div class="mb-3">
                <a href="{{ route('comment.edit', ['comment' => $comment->id]) }}" class="btn btn-sm btn-warning">Edit Comment</a>
                <form action="{{ route('comment.destroy', ['comment' => $comment->id]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this comment?')">Delete Comment</button>
                </form>
            </div>
            @endif
            <!-- End --> 
        </div>
    </div>
    @endforeach
</main>
@endsection
