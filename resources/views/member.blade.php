@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>รายชื่อสมาชิกทั้งหมด</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>ชื่อ</th>
                                <th>อีเมล</th>
                        </thead>
                        <tbody>
                            @csrf
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

        <!-- แสดงรายชื่อผู้ใช้ -->
        <h3>รายชื่อสมาชิกทั้งหมด</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>ชื่อ</th>
                    <th>อีเมล</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection