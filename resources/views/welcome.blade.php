@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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

</main>
@endsection