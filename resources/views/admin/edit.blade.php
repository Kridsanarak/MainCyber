@extends('layouts.adminapp')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if(auth()->check() && auth()->user()->isAdmin)
                <div class="card">
                    <div class="card-header">
                        <h4>แก้ไขข้อมูลผู้ใช้
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
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" />
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label>รหัสผ่าน :</label>
                                <input type="password" name="password" class="form-control" placeholder="ใส่รหัสผ่านใหม่ (ไม่บังคับ)" />
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                @else
                <div class="alert alert-danger">คุณไม่มีสิทธิ์แก้ไขข้อมูลผู้ใช้</div>
            @endif
        </div>
    </div>
</div>
@endsection
