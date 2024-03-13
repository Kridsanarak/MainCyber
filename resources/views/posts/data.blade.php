<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Web Board</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Custom Styles -->
    <style>
    body {
        font-family: 'Prompt', sans-serif;
    }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm" aria-label="Main navigation">
            <div class="container">
                <a class="navbar-brand">Web Board</a>
                <a class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </a>
                <a href="{{ url('/posts/create') }}"><button type="button" class="btn btn-primary"
                        data-bs-target="#exampleModal">+ เพิ่มกระทู้</button></a>
                &nbsp
                @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('admin.users') }}"><button type="button"
                        class="btn btn-success">สมาชิกทั้งหมด</button></a>
                @else
                <a href="{{ route('member') }}"><button type="button" class="btn btn-success">สมาชิกทั้งหมด</button></a>
                @endif
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" type="get"
                            action="{{ url('search') }}">
                            <input type="search" class="form-control form-control-white text-bg-white" name="query"
                                type="search" placeholder="Search..." aria-label="Search">
                        </form>
                        
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <button id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </button>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if(auth()->check() && auth()->user()->isAdmin())
                                <a class="dropdown-item" href="{{ url('/admin/home')}}">
                                    {{ __('Home') }}
                                </a>
                                @else
                                <a class="dropdown-item" href="{{ url('/home')}}">
                                    {{ __('Home') }}
                                </a>
                                @endif
                                <a class="dropdown-item" href="{{ url('/mypost')}}">
                                    {{ __('My Post') }}
                                </a>


                                <a class="dropdown-item" href="{{ url('/editprofile')}}">
                                    {{ __('Edit Profile') }}
                                </a>


                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <main class="container">
    <div class="card mb-4">
        <div class="card-body">
            <h4>
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
            </h4>
            <h3 class="card-title">{{ $posts->topic }}</h3>
            <p class="card-text">Posted by: {{ $posts->users_name }} • {{ $posts->updated_at }}</p>
            <p class="card-text">{{ $posts->details }}</p>
            @if($posts->post_pic)
            <img class="img-fluid mb-3" style="max-width: 300px; max-height: 300px;" 
             src="{{ asset($posts->post_pic) }}" alt="Post Image">
            @endif

            <!-- edit/delete post -->
            @if(auth()->check() && (auth()->user()->id === $posts->users_id || auth()->user()->isAdmin()))
            <div class="mb-3">
                <a href="{{ url('posts/'.$posts->id.'/edit') }}" class="btn btn-sm btn-warning">Edit Post</a>
                <form action="{{ url('posts/'.$posts->id.'/delete') }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post and its comments?')">Delete Post</button>
                </form>
            </div>
            @endif
            <!-- end -->


        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('comment.store', ['post' => $posts->id]) }}" method="post" 
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="post_id" value="{{ $posts->id }}">
                <div class="mb-3">
                    <label for="comment_text" class="form-label">Comment</label>
                    <textarea class="form-control" id="comment_text" name="comment_text" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="comment_pic" class="form-label">Image</label>
                    <input type="file" class="form-control" id="comment_pic" name="comment_pic">
                </div>
                @auth
                <!-- Check if user is authenticated -->
                <button type="submit" class="btn btn-primary">Submit</button>
                @else
                <p>&nbspYou must <a href="{{ route('login') }}">login</a> to submit a comment.</p>
                @endauth
            </form>

        </div>
    </div>
    @foreach ($posts->comments as $comment)
    <div class="card mb-3">
        <div class="card-body">
            <p>Comment by: {{ $comment->user->name }} • {{ $comment->updated_at }}</p>
            <h5 class="card-text">{{ $comment->comment_text }}</h5>
            @if ($comment->comment_pic)
            <img style="float: left; max-width: 300px; max-height: 300px; margin-right: 10px;"
                src="{{ asset($comment->comment_pic) }}" alt="Comment Image">
            @endif

            <!-- edit/delete comment -->
            @if(auth()->check() && (auth()->user()->id === $comment->users_id || auth()->user()->isAdmin()))
            <div class="mb-3">
                <a href="{{ route('comment.edit', ['comment' => $comment->id]) }}" class="btn btn-sm btn-warning">Edit Comment</a>
                <form action="{{ route('comment.destroy', ['comment' => $comment->id]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this comment?')">Delete Comment</button>
                </form>
            </div>
            @endif
            <!-- End --> 
        </div>
    </div>
    @endforeach
</main>
        </main>
    </div>
    <!-- Bootstrap Bundle JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>