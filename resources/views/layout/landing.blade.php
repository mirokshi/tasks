<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" href="img/icon.png">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    <meta name="theme-color" content="#317EFB"/>
    <script defer src="https://use.fontawesome.com/releases/v5.6.1/js/all.js" integrity="sha384-R5JkiUweZpJjELPWqttAYmYM1P3SNEJRM6ecTQF05pFFtxmCO+Y1CiUhvuDzgSVZ" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
    <style>
        [v-cloak] > * { display:none; }
    </style>
</head>
<body>
<div id="app" v-cloak>
    @yield('content')
</div>
<script src="{{mix('/js/app.js')}}"></script>

</body>
</html>
