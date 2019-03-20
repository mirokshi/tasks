<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user" content="{{ logged_user() }}">
    <meta name="git" content="{{ git() }}">
    <meta name="impersonatedBy" content="{{ Auth::user()->impersonatedBy() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/icon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/icon-16x16.png">
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
            content: " ";
            display: block;
            width: 40px;
            height: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            background-image: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwcHgiICBoZWlnaHQ9IjIwMHB4IiAgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ieE1pZFlNaWQiIGNsYXNzPSJsZHMtcGFjbWFuIiBzdHlsZT0iYmFja2dyb3VuZDogbm9uZTsiPjxnIG5nLWF0dHItc3R5bGU9ImRpc3BsYXk6e3tjb25maWcuc2hvd0JlYW59fSIgc3R5bGU9ImRpc3BsYXk6YmxvY2siPjxjaXJjbGUgY3g9IjM1LjgxMjgiIGN5PSI1MCIgcj0iNCIgbmctYXR0ci1maWxsPSJ7e2NvbmZpZy5jMn19IiBmaWxsPSIjYzU1MjNmIj48YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJjeCIgY2FsY01vZGU9ImxpbmVhciIgdmFsdWVzPSI5NTszNSIga2V5VGltZXM9IjA7MSIgZHVyPSIxIiBiZWdpbj0iLTAuNjdzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSI+PC9hbmltYXRlPjxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9ImZpbGwtb3BhY2l0eSIgY2FsY01vZGU9ImxpbmVhciIgdmFsdWVzPSIwOzE7MSIga2V5VGltZXM9IjA7MC4yOzEiIGR1cj0iMSIgYmVnaW49Ii0wLjY3cyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZT48L2NpcmNsZT48Y2lyY2xlIGN4PSI1Ni4yMTI4IiBjeT0iNTAiIHI9IjQiIG5nLWF0dHItZmlsbD0ie3tjb25maWcuYzJ9fSIgZmlsbD0iI2M1NTIzZiI+PGFuaW1hdGUgYXR0cmlidXRlTmFtZT0iY3giIGNhbGNNb2RlPSJsaW5lYXIiIHZhbHVlcz0iOTU7MzUiIGtleVRpbWVzPSIwOzEiIGR1cj0iMSIgYmVnaW49Ii0wLjMzcyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZT48YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJmaWxsLW9wYWNpdHkiIGNhbGNNb2RlPSJsaW5lYXIiIHZhbHVlcz0iMDsxOzEiIGtleVRpbWVzPSIwOzAuMjsxIiBkdXI9IjEiIGJlZ2luPSItMC4zM3MiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIj48L2FuaW1hdGU+PC9jaXJjbGU+PGNpcmNsZSBjeD0iNzYuMDEyOCIgY3k9IjUwIiByPSI0IiBuZy1hdHRyLWZpbGw9Int7Y29uZmlnLmMyfX0iIGZpbGw9IiNjNTUyM2YiPjxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9ImN4IiBjYWxjTW9kZT0ibGluZWFyIiB2YWx1ZXM9Ijk1OzM1IiBrZXlUaW1lcz0iMDsxIiBkdXI9IjEiIGJlZ2luPSIwcyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZT48YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJmaWxsLW9wYWNpdHkiIGNhbGNNb2RlPSJsaW5lYXIiIHZhbHVlcz0iMDsxOzEiIGtleVRpbWVzPSIwOzAuMjsxIiBkdXI9IjEiIGJlZ2luPSIwcyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZT48L2NpcmNsZT48L2c+PGcgbmctYXR0ci10cmFuc2Zvcm09InRyYW5zbGF0ZSh7e2NvbmZpZy5zaG93QmVhbk9mZnNldH19IDApIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMTUgMCkiPjxwYXRoIGQ9Ik01MCA1MEwyMCA1MEEzMCAzMCAwIDAgMCA4MCA1MFoiIG5nLWF0dHItZmlsbD0ie3tjb25maWcuYzF9fSIgZmlsbD0iI2YyYjczNiIgdHJhbnNmb3JtPSJyb3RhdGUoMjguNDgwOSA1MCA1MCkiPjxhbmltYXRlVHJhbnNmb3JtIGF0dHJpYnV0ZU5hbWU9InRyYW5zZm9ybSIgdHlwZT0icm90YXRlIiBjYWxjTW9kZT0ibGluZWFyIiB2YWx1ZXM9IjAgNTAgNTA7NDUgNTAgNTA7MCA1MCA1MCIga2V5VGltZXM9IjA7MC41OzEiIGR1cj0iMXMiIGJlZ2luPSIwcyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZVRyYW5zZm9ybT48L3BhdGg+PHBhdGggZD0iTTUwIDUwTDIwIDUwQTMwIDMwIDAgMCAxIDgwIDUwWiIgbmctYXR0ci1maWxsPSJ7e2NvbmZpZy5jMX19IiBmaWxsPSIjZjJiNzM2IiB0cmFuc2Zvcm09InJvdGF0ZSgtMjguNDgwOSA1MCA1MCkiPjxhbmltYXRlVHJhbnNmb3JtIGF0dHJpYnV0ZU5hbWU9InRyYW5zZm9ybSIgdHlwZT0icm90YXRlIiBjYWxjTW9kZT0ibGluZWFyIiB2YWx1ZXM9IjAgNTAgNTA7LTQ1IDUwIDUwOzAgNTAgNTAiIGtleVRpbWVzPSIwOzAuNTsxIiBkdXI9IjFzIiBiZWdpbj0iMHMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIj48L2FuaW1hdGVUcmFuc2Zvcm0+PC9wYXRoPjwvZz48L3N2Zz4=");
        }
    </style>
</head>
<body style="background: linear-gradient(to top, #00c6fb 0%, #005bea 100%) fixed; background: -webkit-linear-gradient(to top, #00c6fb 0%, #005bea 100%) fixed">
<div id="app"  v-cloak>
    <noscript>
        <strong>We're sorry but frontend doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
    </noscript>
    <v-app>
        <snackbar></snackbar>
        <service-worker></service-worker>
        <navigation v-model="drawer"></navigation>
        <navigation-right
            csrf-token="{{ csrf_token()}}"
            v-model="drawerRight"></navigation-right>
        <toolbar
                 @toggle-right="drawerRight=!drawerRight"
                 @toggle-left="drawer=!drawer"
        ></toolbar>
        <v-content>
            @yield('content')
        </v-content>
        <v-footer color="primary" app>
            <span class="white--text pl-3" >&copy; {{date('Y')}} Rojas Diaz Mirokshi</span>
        </v-footer>
    </v-app>
</div>
</body>
</html>
