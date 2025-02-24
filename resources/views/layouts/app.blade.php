<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('posts.index') }}">Blog</a>
            @auth
            <div class="d-flex gap-2">
            <a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm"> All Posts</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
            @endauth
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
     
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     @stack('scripts')
</body>
</html>

