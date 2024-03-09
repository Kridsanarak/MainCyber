@extends('layouts.memberapp')

@section('content')
<main class="container">
    <div class="card-body">
        <h3>กระทู้</h3>
        @csrf
        @foreach ($posts->sortByDesc('created_at') as $item)
            <div class="card mb-4">
                <div class="card-body">
                    <div style="float: left; margin-right: 10px;">
                        @if($item->user && $item->user->profile_picture)
                            <img style="max-width: 40px; max-height: 30px; border-radius: 50%;" 
                                 src="{{ asset($item->user->profile_picture) }}" alt="User Profile Picture">
                        @else
                        @endif
                    </div>

                    <a href="{{ url('/posts/data', ['id' => $item->id]) }}" style="color: #007bff; text-decoration: none;"
                        onmouseover="this.style.color='#0056b3';" onmouseout="this.style.color='#007bff';">
                        <h5 class="card-title">{{ $item->topic }}</h5>
                    </a>

                    <p class="card-text">Posted by: {{ $item->user ? $item->user->name : 'Unknown User' }} • {{ $item->created_at }}</p>

                    @if($item->post_pic)
                        <img style="max-width: 100px; max-height: 100px; margin-right: 10px;"
                             src="{{ asset($item->post_pic) }}" alt="Post Image">
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div class="pagination justify-content-end">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
</main>
@endsection