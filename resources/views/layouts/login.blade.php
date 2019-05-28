<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="vapidPublicKey" content="{{ config('webpush.vapid.public_key') }}">
    <meta name="user" content="{{ logged_user() }}">
    <meta name="git" content="{{ git() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="/icon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icon-16x16.png">
    <meta name="theme-color" content="#317EFB"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <meta property="og:image" content="/img/shareImage.jpeg" />
    <meta property="og:image:width" content="439" />
    <meta property="og:image:height" content="659" />
    <meta property="og:title" content="Application Tasks" />
    <meta property="og:type" content="website"/>
    <meta property="og:description" content="Description tasks" />
    <meta property="og:url" content="https://tasks.mirokshi.scool.cat/" />
    @stack('beforeScripts')
    <script defer src="{{ url (mix('/js/manifest.js')) }}" type="text/javascript"></script>
    <script defer src="{{ url (mix('/js/vendor.js')) }}" type="text/javascript"></script>
    <script defer src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>
    @stack('afterScripts')
    <title>@yield('title','Put your title here')</title>
    <style>
        [v-cloak] > * { display:none; }
        [v-cloak]::before {
            content: "";
            display: block;
            width: 40px;
            height: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            background-image: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDBweCIgIGhlaWdodD0iNDBweCIgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIiBjbGFzcz0ibGRzLXBhY21hbiIgc3R5bGU9ImJhY2tncm91bmQ6IG5vbmU7Ij48ZyBuZy1hdHRyLXN0eWxlPSJkaXNwbGF5Ont7Y29uZmlnLnNob3dCZWFufX0iIHN0eWxlPSJkaXNwbGF5OmJsb2NrIj48Y2lyY2xlIGN4PSI1OS44MTE4IiBjeT0iNTAiIHI9IjQiIG5nLWF0dHItZmlsbD0ie3tjb25maWcuYzJ9fSIgZmlsbD0iI2YzNzAyMSI+PGFuaW1hdGUgYXR0cmlidXRlTmFtZT0iY3giIGNhbGNNb2RlPSJsaW5lYXIiIHZhbHVlcz0iOTU7MzUiIGtleVRpbWVzPSIwOzEiIGR1cj0iMSIgYmVnaW49Ii0wLjY3cyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZT48YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJmaWxsLW9wYWNpdHkiIGNhbGNNb2RlPSJsaW5lYXIiIHZhbHVlcz0iMDsxOzEiIGtleVRpbWVzPSIwOzAuMjsxIiBkdXI9IjEiIGJlZ2luPSItMC42N3MiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIj48L2FuaW1hdGU+PC9jaXJjbGU+PGNpcmNsZSBjeD0iODAuMjExOCIgY3k9IjUwIiByPSI0IiBuZy1hdHRyLWZpbGw9Int7Y29uZmlnLmMyfX0iIGZpbGw9IiNmMzcwMjEiPjxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9ImN4IiBjYWxjTW9kZT0ibGluZWFyIiB2YWx1ZXM9Ijk1OzM1IiBrZXlUaW1lcz0iMDsxIiBkdXI9IjEiIGJlZ2luPSItMC4zM3MiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIj48L2FuaW1hdGU+PGFuaW1hdGUgYXR0cmlidXRlTmFtZT0iZmlsbC1vcGFjaXR5IiBjYWxjTW9kZT0ibGluZWFyIiB2YWx1ZXM9IjA7MTsxIiBrZXlUaW1lcz0iMDswLjI7MSIgZHVyPSIxIiBiZWdpbj0iLTAuMzNzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSI+PC9hbmltYXRlPjwvY2lyY2xlPjxjaXJjbGUgY3g9IjQwLjAxMTgiIGN5PSI1MCIgcj0iNCIgbmctYXR0ci1maWxsPSJ7e2NvbmZpZy5jMn19IiBmaWxsPSIjZjM3MDIxIj48YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJjeCIgY2FsY01vZGU9ImxpbmVhciIgdmFsdWVzPSI5NTszNSIga2V5VGltZXM9IjA7MSIgZHVyPSIxIiBiZWdpbj0iMHMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIj48L2FuaW1hdGU+PGFuaW1hdGUgYXR0cmlidXRlTmFtZT0iZmlsbC1vcGFjaXR5IiBjYWxjTW9kZT0ibGluZWFyIiB2YWx1ZXM9IjA7MTsxIiBrZXlUaW1lcz0iMDswLjI7MSIgZHVyPSIxIiBiZWdpbj0iMHMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIj48L2FuaW1hdGU+PC9jaXJjbGU+PC9nPjxnIG5nLWF0dHItdHJhbnNmb3JtPSJ0cmFuc2xhdGUoe3tjb25maWcuc2hvd0JlYW5PZmZzZXR9fSAwKSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTE1IDApIj48cGF0aCBkPSJNNTAgNTBMMjAgNTBBMzAgMzAgMCAwIDAgODAgNTBaIiBuZy1hdHRyLWZpbGw9Int7Y29uZmlnLmMxfX0iIGZpbGw9IiNmY2I3MTEiIHRyYW5zZm9ybT0icm90YXRlKDcuNTE3NyA1MCA1MCkiPjxhbmltYXRlVHJhbnNmb3JtIGF0dHJpYnV0ZU5hbWU9InRyYW5zZm9ybSIgdHlwZT0icm90YXRlIiBjYWxjTW9kZT0ibGluZWFyIiB2YWx1ZXM9IjAgNTAgNTA7NDUgNTAgNTA7MCA1MCA1MCIga2V5VGltZXM9IjA7MC41OzEiIGR1cj0iMXMiIGJlZ2luPSIwcyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZVRyYW5zZm9ybT48L3BhdGg+PHBhdGggZD0iTTUwIDUwTDIwIDUwQTMwIDMwIDAgMCAxIDgwIDUwWiIgbmctYXR0ci1maWxsPSJ7e2NvbmZpZy5jMX19IiBmaWxsPSIjZmNiNzExIiB0cmFuc2Zvcm09InJvdGF0ZSgtNy41MTc3IDUwIDUwKSI+PGFuaW1hdGVUcmFuc2Zvcm0gYXR0cmlidXRlTmFtZT0idHJhbnNmb3JtIiB0eXBlPSJyb3RhdGUiIGNhbGNNb2RlPSJsaW5lYXIiIHZhbHVlcz0iMCA1MCA1MDstNDUgNTAgNTA7MCA1MCA1MCIga2V5VGltZXM9IjA7MC41OzEiIGR1cj0iMXMiIGJlZ2luPSIwcyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZVRyYW5zZm9ybT48L3BhdGg+PC9nPjwvc3ZnPg==");
        }
    </style>
</head>
<body style="background: linear-gradient(to top, #00c6fb 0%, #005bea 100%) fixed; background: -webkit-linear-gradient(to top, #00c6fb 0%, #005bea 100%) fixed">
<div id="app" v-cloak>
    <v-app id="inspire">
        @yield('content')
    </v-app>
</div>
</body>
</html>
