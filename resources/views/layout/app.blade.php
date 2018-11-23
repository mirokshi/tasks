<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user" content="{{ logged_user() }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
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
            <v-list>
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
                        <v-list-tile slot="activator" :href="item.url">
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    @{{ item.text }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile
                                v-for="(child, i) in item.children"
                                :key="i"
                                :href="child.url"
                        >
                            <v-list-tile-action v-if="child.icon">
                                <v-icon>@{{ child.icon }}</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    @{{ child.text }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list-group>
                    <v-list-tile v-else :key="item.text" :href="item.url">
                        <v-list-tile-action>
                            <v-icon>@{{ item.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                @{{ item.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>
            </v-list>
        </v-navigation-drawer>
        <v-navigation-drawer
                v-model="drawerRight"
                fixed
                right
                clipped
                app
        >
            <v-card>
                ADMINISTRADOR
                @canImpersonate
                <user-select @selected="impersonate" url="/api/v1/regular_users/"></user-select>
                @endCanImpersonate

                @impersonating

                El usuario  {{ Auth::user()->name }} esta suplantando a {{ Auth::user()->impersonatedBy()->name }}
                <a href="/impersonate/leave">Abandonar la suplantacion</a>

                @endImpersonating
            </v-card>
        </v-navigation-drawer>
        <v-toolbar color="grey darken-4" flat dark app >
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Application</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-avatar @click.stop="drawerRight = !drawerRight" title="{{ Auth::user()->name }} ( {{ Auth::user()->email }} )">
                <img src="https://www.gravatar.com/avatar/{{md5(Auth::user()-> email)}}" alt="avatar">
            </v-avatar>
            <v-form action="/logout" method="POST">
            @csrf
                <v-btn color="transparent" type="submit">LOGOUT</v-btn>
            </v-form>
        </v-toolbar>
        <v-content>
            @yield('content')
        </v-content>
        <v-footer color="grey darken-4" app>
            <span class="white--text pl-3">&copy; 2018 Rojas Diaz Mirokshi</span>
        </v-footer>
    </v-app>
</div>
    <script src="{{mix('/js/app.js')}}"></script>
</body>
</html>
