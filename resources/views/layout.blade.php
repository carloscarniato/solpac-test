<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Solpac</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>
        @component('navbar')
        @endcomponent

        @yield('content')
    </body>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
</html>
