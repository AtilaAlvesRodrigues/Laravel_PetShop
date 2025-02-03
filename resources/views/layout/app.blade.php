<!DOCTYPE html>
<html>
    <head>
        <title>Petshop</title>
        link rel="stylesheet" type="{{ asset('css/app.css') }}">
    </head>
    <body>
        <nav>
            </nav>

        <div class="container">
            @yield('content')
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>