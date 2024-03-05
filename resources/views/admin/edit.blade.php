@extends('layouts.adminapp')
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
                        <a href="{{ url('/admin/users')}}" class="btn btn-primary float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('user/' . $user->id . '/edit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>ชื่อ :</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" />
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>อีเมล :</label>
                            <textarea name="email" class="form-control" rows="3">{{ $user->email }}</textarea>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>รหัสผ่าน :</label>
                            <textarea name="password" class="form-control" rows="3">{{ $user->password }}</textarea>
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection