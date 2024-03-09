@extends('layouts.adminapp')

@section('content')
<main class="container">
    <div class="card-body">
        <h3>กระทู้</h3>
        @csrf
        @foreach ($posts->sortByDesc('created_at') as $item)
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <a href="{{ url('/posts/data', ['id' => $item->id]) }}"
                    style="color: #007bff; text-decoration: none;" onmouseover="this.style.color='#0056b3';"
                    onmouseout="this.style.color='#007bff';">
                    <h5 style="margin-left: 0.5rem;" class="card-title">{{ $item->topic }}</h5>
                </a>
            </div>
            <p style="margin-left: 1.5rem; " class="card-text">Posted by : {{ $item->users_name }} • {{ $item->updated_at }}</p>
            @if($item->post_pic)
            <img style="float: left; max-width: 100px; max-height: 100px; margin-right: 10px; margin-left: 1.5rem; margin-bottom: 1rem;"
                src="{{ asset($item->post_pic) }}" alt="Post Image">
            @endif
            <p style="margin-left: 1.5rem; margin-bottom: 1rem;"  class="card-text">{{ $item->details }}</p>
        </div>
        @endforeach
    </div>
    <div class="pagination justify-content-end">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
</main>
@endsection
