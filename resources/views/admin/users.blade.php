@extends('layouts.adminapp')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 style="margin-top: 0.5rem">รายชื่อสมาชิกทั้งหมด
                    <a href="{{ url('/admin/home')}}"  class="btn btn-primary float-end" style="margin-top: -0.3rem;" >Back to Admin Home</a></h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>ชื่อ</th>
                                <th>อีเมล</th>
                                <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <a href="{{ url('user/'.$user->id.'/edit') }}" class="btn btn-warning mx-2">Edit</a>
                                    <a
                                        href="{{ url('user/'.$user->id.'/delete') }}"
                                        class="btn btn-danger mx-1"
                                        onclick="return confirm('Are you sure ?')"
                                    >
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination justify-content-end">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection