@extends('layouts.memberapp')

@section('content')
<main class="container">
    <div>
        
        <h3>กระทู้</h3>
        <table class="table table-bordered table-striped">
            @foreach ($posts as $item)
            <div class="col">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->topic }}</h5>
                        <!-- Check if the current user owns the post -->
                        @if(auth()->user() && $item->users_id === auth()->user()->id)
                        <!-- Edit Post Button -->
                        <a href="{{ url('posts/'.$item->id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                        <!-- Delete Post Form -->
                        <a href="{{ url('posts/'.$item->id.'/delete') }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure ?')">
                            Delete
                        </a>
                        @endif
                        <p class="card-text">Posted by: {{ $item->users_name }}</p>
                        <p class="card-text">{{ $item->details }}</p>
                        @if($item->post_pic)
                        <img src="{{ asset($item->post_pic) }}" alt="Post Image" >
                        @endif

                        @if($item->comments->count() > 0)
                        @foreach ($item->comments as $comment)
                        <li class="list-group-item">
                            <p>{{ $comment->user->name }} : {{ $comment->comment_text }}</p>
                            @if($comment->comment_pic)
                            <img src="{{ asset($comment->comment_pic) }}" alt="Comment Image" style="max-width: 100%; height: auto;">
                            @endif

                            <!-- Check if the current user is the owner of the comment -->
                            @if(auth()->user() && $comment->users_id === auth()->user()->id)
                            <!-- Edit Comment Button -->
                            <a href="{{ route('comment.edit', ['comment' => $comment->id]) }}" class="btn btn-sm btn-warning">Edit</a>

                            <!-- Delete Comment Form -->
                            <form action="{{ route('comment.destroy', ['comment' => $comment->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                            @endif
                        </li>
                        @endforeach
                        @else
                        <p>No comments yet.</p>
                        @endif

                        <form action="{{ route('comment', ['post' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="comment_text" class="form-label">Comment</label>
                                <textarea class="form-control @error('comment_text') is-invalid @enderror" id="comment_text" name="comment_text" rows="3" required></textarea>
                                @error('comment_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="file" class="form-control @error('comment_pic') is-invalid @enderror" id="comment_pic" name="comment_pic">
                                <p class="small mb-0 mt-2"><b>Note : </b>Only JPG, JPEG, PNG files are allowed to upload.</p>
                                @error('comment_pic')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" name="post_id" value="{{ $item->id }}">
                            
                            <button type="submit" class="btn btn-primary">Post Comment</button>
                        </form>

                    </div>
                </div>
            </div>
            @endforeach

        </table>
    </div>
</main>
@endsection