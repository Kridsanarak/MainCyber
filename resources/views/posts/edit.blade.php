<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Web Board</title>
    <link rel="icon" type="image/png" href="/icon/130319-b-letter-free-download-image.png">

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
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12">

                        @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h4>แก้ไขกระทู้
                                    <a href="javascript:history.back()" class="btn btn-primary float-end">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->id ==
                                $posts->users_id))
                                <form action="{{ url('posts/' . $posts->id . '/edit') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label>หัวข้อกระทู้ :</label>
                                        <input type="text" name="topic" class="form-control"
                                            value="{{ $posts->topic }}" />
                                        @error('topic') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>รายระเอียดกระทู้ :</label>
                                        <textarea name="details" class="form-control"
                                            rows="3">{{ $posts->details }}</textarea>
                                        @error('details') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>เพิ่มรูปภาพ :</label>
                                        <input type="file" name="post_pic" class="form-control" id="postPicInput" />
                                        <p class="small mb-0 mt-2"><b>Note : </b>Only JPG, JPEG, PNG files are allowed
                                            to upload.</p>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                                @else
                                <div class="alert alert-danger">คุณไม่มีสิทธิ์แก้ไขโพสต์นี้</div>
                                @endif
                            </div>
                        </div>

        </main>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('postPicInput');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            const fileSize = file.size;
            const fileType = file.type;
            const validExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
            const maxSize = 2 * 1024 * 1024; // 2MB

            if (!validExtensions.includes(fileType)) {
                alert('Only JPG, JPEG, PNG files are allowed to upload.');
                this.value = ''; // Clear file input
            } else if (fileSize > maxSize) {
                alert('The image size cannot exceed 2MB.');
                this.value = ''; // Clear file input
            }
        });
    });
    </script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>