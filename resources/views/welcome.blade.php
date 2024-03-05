@extends('layouts.app')

@section('content')
<main class="container">
    <div class="card-body">
        <h3>กระทู้</h3>
        @foreach ($posts as $item)
        <div class="card mb-4">
            <div class="card-body">
                <a href="{{ url('/posts/data', ['id' => $item->id]) }}"><h5 class="card-title">{{ $item->topic }}</h5></a>
                <p class="card-text">Posted by : {{ $item->users_name }} -> {{ $item->created_at }}</p>
                @if($item->post_pic)
                <img style="float: left; max-width: 100px; max-height: 100px; margin-right: 10px;" src="{{ asset($item->post_pic) }}" alt="Post Image">
                @endif
                <p class="card-text">{{ $item->details }}</p>
            </div>
        </div>
        @endforeach
    </div>
</main>
@endsection
