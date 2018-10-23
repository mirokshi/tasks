<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet"> {{--tailwinds--}}
    <title>@yield('title','Put your title here')</title>

</head>
<body>
<div id="app">
    <v-app>
        <v-navigation-drawer
                v-model="drawer"
                fixed
                app

        >
            <v-list dense>
                <template v-for="item in items">
                    <v-layout
                            v-if="item.heading"
                            :key="item.heading"
                            row
                            align-center
                    >
                        <v-flex xs6>
                            <v-subheader v-if="item.heading">
                               @{{ item.heading }}
                            </v-subheader>
                        </v-flex>
                        <v-flex xs6 class="text-xs-center">
                            <a href="#!" class="body-2 black--text">EDIT</a>
                        </v-flex>
                    </v-layout>
                    <v-list-group
                            v-else-if="item.children"
                            v-model="item.model"
                            :key="item.text"
                            :prepend-icon="item.model ? item.icon : item['icon-alt']"
                            append-icon=""
                    >
                {{--<v-list-tile href="welcome">--}}
                    {{--<v-list-tile-action>--}}
                        {{--<v-icon>home</v-icon>--}}
                    {{--</v-list-tile-action>--}}
                    {{--<v-list-tile-content>--}}
                        {{--<v-list-tile-title>Welcome</v-list-tile-title>--}}
                    {{--</v-list-tile-content>--}}
                {{--</v-list-tile>--}}

                {{--<v-list-tile href="tasks">--}}
                    {{--<v-list-tile-action>--}}
                        {{--<v-icon>work</v-icon>--}}
                    {{--</v-list-tile-action>--}}
                    {{--<v-list-tile-content>--}}
                        {{--<v-list-tile-title>Tasks con PHP</v-list-tile-title>--}}
                    {{--</v-list-tile-content>--}}
                {{--</v-list-tile>--}}

                {{--<v-list-tile href="tasks_vue">--}}
                    {{--<v-list-tile-action>--}}
                        {{--<v-icon>work</v-icon>--}}
                    {{--</v-list-tile-action>--}}
                    {{--<v-list-tile-content>--}}
                        {{--<v-list-tile-title>Tasks con Vue</v-list-tile-title>--}}
                    {{--</v-list-tile-content>--}}
                {{--</v-list-tile>--}}
                {{--<v-list-tile href="about">--}}
                    {{--<v-list-tile-action>--}}
                        {{--<v-icon>account_box</v-icon>--}}
                    {{--</v-list-tile-action>--}}
                    {{--<v-list-tile-content>--}}
                        {{--<v-list-tile-title>Contact</v-list-tile-title>--}}
                    {{--</v-list-tile-content>--}}
                {{--</v-list-tile>--}}
                    </v-list-group>
                </template>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar color="indigo" dark fixed app>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Tasks</v-toolbar-title>
        </v-toolbar>
        <v-content>
            <v-container fluid fill-height >
                <v-layout>
                    <v-flex justify-center  >
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
</div>
    <script src="{{mix('/js/app.js')}}"></script>
</body>
</html>
