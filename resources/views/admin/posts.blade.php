@extends('layouts.adminapp')

@section('content')
<main class="container">
    <div class="card-body">
        <h3>กระทู้</h3>
        @csrf
        @foreach ($posts->sortByDesc('created_at') as $item)
        <div class="card mb-4">
            <div class="card-body">
                <a href="{{ url('/posts/data', ['id' => $item->id]) }}"
                    class="d-flex justify-content-between align-items-center"
                    style="color: #007bff; text-decoration: none;" onmouseover="this.style.color='#0056b3';"
                    onmouseout="this.style.color='#007bff';">
                    <h5 class="card-title">{{ $item->topic }}</h5>
                    <div>
                        <button class="btn btn-warning mx-2">Edit</button>
                        <button class="btn btn-danger mx-1">Delete</button>
                    </div>
                </a>
                <p class="card-text">Posted by : {{ $item->users_name }} • {{ $item->created_at }}</p>
                @if($item->post_pic)
                <img style="float: left; max-width: 100px; max-height: 100px; margin-right: 10px;"
                    src="{{ asset($item->post_pic) }}" alt="Post Image">
                @endif
                <p class="card-text">{{ $item->details }}</p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="pagination justify-content-end">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
</main>
@endsection