@extends('layouts.adminapp')

@section('content')
<div class="container mt-3">
    <table class="table table-bordered table-striped">
        @csrf
        @foreach ($posts as $item)
        <div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->topic }}</h5>
                    <!-- Edit and Delete Post Buttons -->
                    <div class="mb-3">
                        <a href="{{ url('posts/'.$item->id.'/edit') }}" class="btn btn-sm btn-warning">Edit Post</a>
                        <a href="{{ url('posts/'.$item->id.'/delete') }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</a>
                    </div>
                    <p class="card-text">Posted by: {{ $item->users_name }}</p>
                    <p class="card-text">{{ $item->details }}</p>
                    @if($item->post_pic)
                    <img src="{{ asset($item->post_pic) }}" alt="Post Image">
                    @endif

                    <!-- Comments Section -->
                    <div class="mt-3">
                        <h6>Comments:</h6>
                        @if($item->comments->count() > 0)
                        <ul class="list-group">
                            @foreach ($item->comments as $comment)
                            <li class="list-group-item">
                                <p>{{ $comment->user->name }} : {{ $comment->comment_text }}</p>
                                @if($comment->comment_pic)
                                <img src="{{ asset($comment->comment_pic) }}" alt="Comment Image" style="width: 100px; height: 100px;">
                                @endif
                                <!-- Edit and Delete Comment Buttons -->
                                <div class="mb-3">
                                    <a href="{{ route('comment.edit', ['comment' => $comment->id]) }}" class="btn btn-sm btn-warning">Edit Comment</a>
                                    <form action="{{ route('comment.destroy', ['comment' => $comment->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this comment?')">Delete Comment</button>
                                    </form>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p>No comments yet.</p>
                        @endif
                    </div>

                    <!-- Comment Form -->
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
@endsection