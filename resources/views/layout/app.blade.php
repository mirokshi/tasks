<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    {{--link vuetify--}}
</head>
<body>
HEADER
<nav>
        <ul><li><a href="tasks">Tareas con PHP</a> </li></ul>
        <ul><li><a href="tasks_vue">Tareas con Vue</a></li></ul>
        <ul><li><a href="about">Contact</a></li></ul>

</nav>
<div id="app">
    @yield('content')
</div>
FOOTER
<script src="/js/app.js"></script>
</body>
</html>
