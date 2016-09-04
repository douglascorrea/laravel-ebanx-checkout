<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ebanx</title>

        <!-- Fonts -->
        <link href="{{ elixir('css/app.css') }}" rel="stylesheet" type="text/css">

    </head>
    <body>

        @include('navbar')

        @yield('content')

        <script type="application/javascript" src="{{ elixir('js/app.js') }}"></script>
    </body>
</html>
