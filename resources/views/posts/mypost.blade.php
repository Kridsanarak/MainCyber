@extends('layouts.memberapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @csrf
                <div class="card-header">กระทู้ของฉัน
                @guest
                <a href="{{ route('welcome') }}" class="btn btn-primary float-end">Back</a>
                @endguest
                @auth
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.home') }}" class="btn btn-primary float-end">Back to Admin Home</a>
                @else
                <a href="{{ route('home') }}" class="btn btn-primary float-end">Back</a>
                @endif
                @endauth
                </div>

                <div class="card-body">
                    @if (count($posts) > 0)
                    <ul class="list-group">
                        @foreach ($posts as $post)
                        @if ($post->users_id === auth()->user()->id)
                        <li class="list-group-item">
                            <a href="{{ route('posts.data', $post->id) }}">{{ $post->topic }}</a>
                            <p class="card-text">Posted at : {{ $post->created_at }}</p>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                    @else
                    <p>You haven't created any posts yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

