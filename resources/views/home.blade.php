@extends('layouts.memberapp')

@section('content')
<main class="container">
    <div class="card-body">
        <h3>กระทู้</h3>
        @csrf
        @foreach ($posts as $item)
        <div class="card mb-4">
            <div class="card-body">
                <a href="{{ url('/posts/data', ['id' => $item->id]) }}" style="color: #007bff; text-decoration: none;"
                    onmouseover="this.style.color='#0056b3';" onmouseout="this.style.color='#007bff';">
                    <h5 class="card-title">{{ $item->topic }}</h5>
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