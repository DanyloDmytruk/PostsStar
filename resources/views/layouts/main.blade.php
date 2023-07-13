<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ $pageTitle }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="fa-solid fa-star"></i> PostsStar</a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link {{ $activeLink == 'home' ? "active" : "" }}" href="{{ route('home') }}"> <i class="fa-solid fa-house"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeLink == 'posts' ? "active" : "" }}" href="{{ route('posts') }}"><i class="fa-solid fa-comments"></i> Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeLink == 'about' ? "active" : "" }}" href="{{ route('about') }}"><i class="fa-solid fa-circle-info"></i> About</a>
                        </li>

                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    
                    <form method="get" action="{{ route('logout') }}" class="d-flex" style="margin-left: 1em">
                        <button class="btn btn-outline-info" type="submit">Log out <i class="fa-solid fa-arrow-right-from-bracket"></i></button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">{{ $mainTitle }}</h1>
            @yield('main_content')
            
        </div>


    </main>


</body>

</html>
