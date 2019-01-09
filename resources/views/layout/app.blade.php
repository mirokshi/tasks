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

    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#317EFB"/>

    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <title>@yield('title','Put your title here')</title>
    <style>
        [v-cloak] > * { display:none; }
        [v-cloak]::before {
            content: " ";
            display: block;
            width: 16px;
            height: 16px;
            background-image: url('data:image/gif;base64,R0lGODlhEAAQAPIAAP///wAAAMLCwkJCQgAAAGJiYoKCgpKSkiH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAADMwi63P4wyklrE2MIOggZnAdOmGYJRbExwroUmcG2LmDEwnHQLVsYOd2mBzkYDAdKa+dIAAAh+QQJCgAAACwAAAAAEAAQAAADNAi63P5OjCEgG4QMu7DmikRxQlFUYDEZIGBMRVsaqHwctXXf7WEYB4Ag1xjihkMZsiUkKhIAIfkECQoAAAAsAAAAABAAEAAAAzYIujIjK8pByJDMlFYvBoVjHA70GU7xSUJhmKtwHPAKzLO9HMaoKwJZ7Rf8AYPDDzKpZBqfvwQAIfkECQoAAAAsAAAAABAAEAAAAzMIumIlK8oyhpHsnFZfhYumCYUhDAQxRIdhHBGqRoKw0R8DYlJd8z0fMDgsGo/IpHI5TAAAIfkECQoAAAAsAAAAABAAEAAAAzIIunInK0rnZBTwGPNMgQwmdsNgXGJUlIWEuR5oWUIpz8pAEAMe6TwfwyYsGo/IpFKSAAAh+QQJCgAAACwAAAAAEAAQAAADMwi6IMKQORfjdOe82p4wGccc4CEuQradylesojEMBgsUc2G7sDX3lQGBMLAJibufbSlKAAAh+QQJCgAAACwAAAAAEAAQAAADMgi63P7wCRHZnFVdmgHu2nFwlWCI3WGc3TSWhUFGxTAUkGCbtgENBMJAEJsxgMLWzpEAACH5BAkKAAAALAAAAAAQABAAAAMyCLrc/jDKSatlQtScKdceCAjDII7HcQ4EMTCpyrCuUBjCYRgHVtqlAiB1YhiCnlsRkAAAOwAAAAAAAAAAAA==');
        }
    </style>
</head>
<body>
<div id="app"  v-cloak>
    <v-app>
        <snackbar></snackbar>
        <v-navigation-drawer
                v-model="drawer"
                fixed
                clipped
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
                <v-card-title class="grey darken-3 white--text"><h4>Perfil</h4></v-card-title>
                <v-layout row wrap>
                    <v-flex xs12>
                        <ul>
                            <li>Nom : {{ Auth::user()->name }}</li>
                            <li>Email : {{ Auth::user()->email }}</li>
                            <li>Admin : {{ Auth::user()->admin ? 'SI' : 'NO' }}</li>
                            <li>Roles : {{ implode(',',Auth::user()->map()['roles']) }}</li>
                            <li>Permissions : {{ implode(', ',Auth::user()->map()['permissions']) }}</li>
                        </ul>
                    </v-flex>
                </v-layout>
            </v-card>
            <v-card>
                <v-card-title class="grey darken-3 white--text"><h4>Opciones de administrador</h4></v-card-title>

                <v-layout row wrap>
                    @impersonating
                    <v-flex xs12>
                        <v-avatar title="{{ Auth::user()->impersonatedBy()->name }} ( {{ Auth::user()->email }} )">
                            <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->impersonatedBy()->email) }}" alt="avatar">
                        </v-avatar>
                    </v-flex>
                    @endImpersonating
                    <v-flex xs12>
                        @canImpersonate
                        <impersonate label="Entrar como..."url="/api/v1/regular_users"></impersonate>
                        {{--<user-select label="Entrar como..." @selected="impersonate" url="/api/v1/regular_users"></user-select>--}}
                        @endCanImpersonate
                        @impersonating
                        {{ Auth::user()->impersonatedBy()->name }} esta suplatanto a {{ Auth::user()->name }}
                        <a href="impersonate/leave">Abandonar la suplantación</a>
                        @endImpersonating
                    </v-flex>
                </v-layout>
            </v-card>
        </v-navigation-drawer>
        <v-toolbar
                color="primary"
                dark
                app
                clipped-left
                clipped-right
                fixed
        >
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Application</v-toolbar-title>
            <v-spacer></v-spacer>
            <span v-role="'SuperAdmin'"><git-info></git-info></span>

            <v-avatar @click.stop="drawerRight = !drawerRight" title="{{ Auth::user()->name }} ( {{ Auth::user()->email }} )">
                <img src="https://www.gravatar.com/avatar/{{md5(Auth::user()-> email)}}" alt="avatar">
            </v-avatar>
            <v-form action="/logout" method="POST">
            @csrf
                <v-btn color="transparent" type="submit"><v-icon>exit_to_app</v-icon></v-btn>
            </v-form>
            <v-btn href="/"><v-icon>home</v-icon></v-btn>
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
