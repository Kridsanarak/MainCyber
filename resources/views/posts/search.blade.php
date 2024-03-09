@extends('layouts.memberapp')
@section('content')
<main class="container mt-3">
    <div>
        <a href="{{ route('home') }}" class="btn btn-primary float-end">Back</a>
        <h3>กระทู้</h3>
        @csrf
        @if(count($posts) > 0)
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
                    </div>
                </div>
                @endforeach
            </table>
        @else
            <p style="margin-top: 2.5rem;" >Your search didn't match any posts yet.</p>
        @endif
    </div>
</main>
@endsection