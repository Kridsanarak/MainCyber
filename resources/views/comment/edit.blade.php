@extends('layouts.memberapp')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Edit Comment
                        <!-- Check if the user is an admin, if yes, show the Back to Admin button -->
                        @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.posts') }}" class="btn btn-primary float-end">Back to Admin</a>

                        @else
                        <a href="{{ route('home') }}" class="btn btn-primary float-end">Back</a>
                        @endif
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('comment.update', ['comment' => $comment->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="comment_text" class="form-label">Comment Text :</label>
                            <textarea id="comment_text" name="comment_text" class="form-control" rows="3">{{ $comment->comment_text }}</textarea>
                            @error('comment_text') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="comment_pic" class="form-label">Comment Picture :</label>
                            <input type="file" id="comment_pic" name="comment_pic" class="form-control" />
                            <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG files are allowed to upload.</p>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection