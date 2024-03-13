@extends('layouts.memberapp')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('welcome') }}" class="btn btn-primary float-end" style="margin-bottom: 1rem; margin-top: 0.5rem;">Back</a>
                    <h4 style="margin-top: 0.7rem; margin-left: 0.5rem;">รายชื่อสมาชิกทั้งหมด</h4>
                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" type= "get" action="{{ url('searchMember') }}">
                        <input type="search" class="form-control form-control-white text-bg-white" style="margin-bottom: 1.0rem;" name="query" type="search" placeholder="Search..." aria-label="Search">
                    </form>
                </div>
                
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>ชื่อผู้ใช้</th>
                            </tr>
                        </thead>
                        <tbody>

                            @csrf
                            @foreach ($users as $user)
                            @if ($user->isAdmin())
                            @elseif (!$user->isAdmin())
                            <tr class="text-center">
                                <td>{{$user->name}}</td>
                            </tr>
                            @endif
                            @endforeach

                        </tbody>
                    </table>
                    <!-- Pagination links -->
                    <div class="pagination justify-content-end">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection