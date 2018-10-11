<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <title>Document</title>
    {{--link vuetify--}}
</head>
<body>
    <v-app id="app">
        <v-navigation-drawer
                v-model="drawer"
                fixed
                app

        >
            <v-list dense>
                <v-list-tile href="welcome">
                    <v-list-tile-action>
                        <v-icon>home</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Welcome</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

                <v-list-tile href="tasks">
                    <v-list-tile-action>
                        <v-icon>work</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Tasks con PHP</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

                <v-list-tile href="tasks_vue">
                    <v-list-tile-action>
                        <v-icon>work</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Tasks con Vue</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile href="about">
                    <v-list-tile-action>
                        <v-icon>account_box</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Contact</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar color="indigo" dark fixed app>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>PHP Learning</v-toolbar-title>
        </v-toolbar>
        <v-content>
            <v-container fluid fill-height >
                <v-layout
                        justify-center

                >
                    <v-flex text-xs-center>

                        {{--<nav>--}}
                            {{--<ul><a href="welcome">Welcome</a></ul>--}}
                            {{--<ul><li><a href="tasks">Tareas con PHP</a> </li></ul>--}}
                            {{--<ul><li><a href="tasks_vue">Tareas con Vue</a></li></ul>--}}
                            {{--<ul><li><a href="about">Contact</a></li></ul>--}}

                        {{--</nav>--}}
                        <div id="app">
                            @yield('content')
                        </div>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
        <v-footer color="indigo" app>
            <span class="white--text"> Created by Mirokshi Rojas. &copy;2018 All rights reserved</span>
        </v-footer>
    </v-app>
<script src="/js/app.js"></script>
</body>
</html>
