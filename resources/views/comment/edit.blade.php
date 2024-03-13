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
                        <a href="javascript:history.back()" class="btn btn-primary float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->id == $comment->users_id))
                    <form action="{{ route('comment.update', ['comment' => $comment->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="comment_text" class="form-label">Comment Text :</label>
                            <textarea id="comment_text" name="comment_text" class="form-control"
                                rows="3">{{ $comment->comment_text }}</textarea>
                            @error('comment_text') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="comment_pic" class="form-label">Image</label>
                            <input type="file" class="form-control" id="comment_pic" name="comment_pic">
                            <p class="small mb-0 mt-2"><b>Note : </b>Only JPG, JPEG, PNG files are allowed to upload and
                                the image size cannot exceed 2MB.</p>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    @else
                    <div class="alert alert-danger">คุณไม่มีสิทธิ์แก้ไขความคิดเห็นนี้</div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('comment_pic');

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        const fileSize = file.size;
        const fileType = file.type;
        const validExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
        const maxSize = 2 * 1024 * 1024; // 2MB

        if (!validExtensions.includes(fileType)) {
            alert('Only JPG, JPEG, PNG files are allowed to upload.');
            this.value = ''; // Clear file input
        } else if (fileSize > maxSize) {
            alert('The image size cannot exceed 2MB.');
            this.value = ''; // Clear file input
        }
    });
});
</script>
@endsection