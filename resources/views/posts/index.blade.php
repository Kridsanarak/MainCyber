@extends('layouts.memberapp')
@section('content')
<main class="container mt-3">
    <div>
        <h3>กระทู้</h3>
        <table class="table table-bordered table-striped">
            @foreach ($posts as $item)
            <div class="col">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->topic }}</h5>
                        <p class="card-text">Posted by: {{ $item->users_name }}</p>
                        <p class="card-text">{{ $item->details }}</p>
                        <img src="{{ asset($item->post_pic) }}" style="width: 150px; height: 150px;" alt="Post Image">
                    </div>
                    <a href="{{ url('posts/'.$item->id.'/edit') }}" class="btn btn-success mx-2">Edit</a>
                            <a
                                href="{{ url('posts/'.$item->id.'/delete') }}"
                                class="btn btn-danger mx-1"
                                onclick="return confirm('Are you sure ?')"
                            >
                                Delete
                            </a>
                </div>
            </div>
            @endforeach
        </table>
    </div>
</main>
</div>
@endsection