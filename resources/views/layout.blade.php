<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Ebanx</title>

        <!-- Fonts -->
        <link href="{{ elixir('css/app.css') }}" rel="stylesheet" type="text/css">
        @yield('header')
    </head>
    <body>

        @include('navbar')

        @yield('content')

        <script type="application/javascript" src="{{ elixir('js/app.js') }}"></script>
        
        <script type="text/javascript">
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
        </script>
    </body>
</html>
