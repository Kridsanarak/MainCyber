@extends('layouts.memberapp')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <a href="{{ route('welcome') }}" class="btn btn-primary float-end">Back</a>
                    <h4 style="margin-top: 0.3rem;">รายชื่อสมาชิกทั้งหมด</h4>
                    
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>ชื่อ</th>
                                <th>อีเมล</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @if (!$user->isAdmin())
                                    <tr class="text-center">
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection