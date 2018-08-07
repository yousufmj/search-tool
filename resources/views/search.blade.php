<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.laravel = { csrfToken: '{{ csrf_token() }}'}</script>

        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">

        <title>Search Tool</title>

    </head>

    <body>
        <div id="app">
            <search></search>

        </div>

    <script src="{{ asset('js/app.js')}}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=initMap"
    type="text/javascript"></script>
    </body>
</html>