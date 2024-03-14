<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <title>Sortie Campus @yield('title')</title>
</head>
<body>
    <header>
        @include('inc.nav')
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        @include('inc.footer')
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIyT9pA/3Nhw0G1nDfTjW3TQpH4Lrqv6Q+vXcCFH1NiSz8K6C4Bx3Ubs" crossorigin="anonymous"></script>

</body>
</html>
