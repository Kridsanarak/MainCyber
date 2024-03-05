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
                    <h4>แก้ไขกระทู้
                        @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.posts') }}" class="btn btn-primary float-end">Back to Admin</a>

                        @else
                        <a href="{{ route('home') }}" class="btn btn-primary float-end">Back</a>
                        @endif
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('posts/' . $posts->id . '/edit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>หัวข้อกระทู้ :</label>
                            <input type="text" name="topic" class="form-control" value="{{ $posts->topic }}" />
                            @error('topic') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>รายระเอียดกระทู้ :</label>
                            <textarea name="details" class="form-control" rows="3">{{ $posts->details }}</textarea>
                            @error('details') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>เพิ่มรูปภาพ :</label>
                            <input type="file" name="post_pic" class="form-control" />
                            <p class="small mb-0 mt-2"><b>Note : </b>Only JPG, JPEG, PNG files are allowed to upload.</p>
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