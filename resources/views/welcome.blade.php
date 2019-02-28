@extends('layouts.landing')
@section('content')
    <v-app light  class="blue-grey lighten-5 white--text">
        <share-fab></share-fab>
        <v-toolbar class="primary white--text">
            <img src="/img/icon.png" alt="Aplicacion de tareas" height="50">
            <v-toolbar-title v-if="$vuetify.breakpoint.mdAndUp">Homepage Tasks</v-toolbar-title>
            <v-spacer></v-spacer>
            @auth
                <v-btn icon @click="" href="/profile">
                    <v-avatar>
                        <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}" alt="avatar">
                    </v-avatar>
                </v-btn>
                <v-form action="/logout" method="POST">
                    @csrf
                    <v-btn class="secondary" type="submit" v-if="$vuetify.breakpoint.mdAndUp">Cerrar Sesion</v-btn>
                </v-form>
            @else
                <v-btn @click="loginForm = !loginForm" class="secondary">Login</v-btn>
                <v-btn @click="registerForm = !registerForm" class="secondary">Register</v-btn>
            @endauth
            <v-dialog v-model="loginForm" max-width="1000">
                <v-card>
                    <login-form v-if="loginForm" email="{{old('email')}}" csrf-token="{{csrf_token()}}"></login-form>
                </v-card>
            </v-dialog>
            <v-dialog v-model="registerForm" max-width="1000">
                <v-card>
                    <register-form v-if="registerForm" email="{{old('email')}}" csrf-token="{{csrf_token()}}"></register-form>
                </v-card>
            </v-dialog>

        </v-toolbar>
        <v-content>
            <section>
                <v-parallax src="img/background.webp" height="600">
                </v-parallax>
                <div class="overlay" style="
                    position:absolute;
                    left:0;
                    top:0;
                    background: rgba(0,0,0,.5);
                    width:100%;
                    height:600px;"
                >
                    <v-layout
                        column
                        align-center
                        justify-center
                        class="white--text"
                        style="height: 100%;"
                    >
                        <h1 class="white--text text--ligthen-2 mb-2 display-4 text-xs-center font-weight-bold"
                            style="text-shadow: 0 0 50px hsla(0, 0%, 0%, .4);font-family: 'Montserrat', sans-serif !important; z-index: 10;"
                            :class="{'display-2': $vuetify.breakpoint.md, 'display-1': $vuetify.breakpoint.xs}"
                        >Aplicación de tareas</h1>
                        <div>
                            <v-btn
                                class="accent darken-1 mt-5 pl-5 pr-5 pt-4 pb-4 headline elevation-5"
                                style="
                        border-radius: 10px;
                        text-decoration: none;
                        "
                                dark
                                large
                                href="/home"
                            >
                                INICIO
                            </v-btn>
                        </div>
                        <v-btn href="https://github.com/mirokshi/tasks" class="black white--text" icon fab >
                            <v-icon>fab fa-github</v-icon>
                        </v-btn>
                        <div class="title mb-3 "> Mode: {{ config('app.env') }}</div>
                    </v-layout>
                </div>
            </section>

            <section>
                <v-layout
                    column
                    wrap
                    class="my-5"
                    align-center

                >
                    <v-flex xs12 sm4 class="my-3 ">
                        <div class="text-xs-center">
                            <h2 class="headline">The best way to start developing</h2>
                            <span class="subheading">
                Cras facilisis mi vitae nunc
              </span>
                        </div>
                    </v-flex>
                    <v-flex xs12 >
                        <v-container grid-list-xl >
                            <v-layout row wrap align-center >
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center ">
                                            <v-icon x-large class="blue--text text--lighten-2">color_lens</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline text-xs-center">Material Design</div>
                                        </v-card-title>
                                        <v-card-text >
                                            Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                            Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon x-large class="blue--text text--lighten-2">flash_on</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline">Fast development</div>
                                        </v-card-title>
                                        <v-card-text>
                                            Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                            Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon x-large class="blue--text text--lighten-2">build</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline text-xs-center">Completely Open Sourced</div>
                                        </v-card-title>
                                        <v-card-text>
                                            Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                            Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-flex>
                </v-layout>
            </section>

            <section>
                <v-parallax src="img/background.webp" height="380">
                    <v-layout column align-center justify-center>
                        <div class="headline white--text mb-3 text-xs-center">Web development has never been easier</div>
                        <em>Kick-start your application today</em>
                        <v-btn
                            class="indigo darken-4 mt-5"
                            dark
                            large
                            href="/pre-made-themes"
                        >
                            Get Started
                        </v-btn>
                    </v-layout>
                </v-parallax>
            </section>

            <section>
                <v-container grid-list-xl>
                    <v-layout row wrap justify-center class="my-5">
                        <v-flex xs12 sm4>
                            <v-card class="elevation-0 transparent">
                                <v-card-title primary-title class="layout justify-center">
                                    <div class="headline">Company info</div>
                                </v-card-title>
                                <v-card-text>
                                    Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                    Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm4 offset-sm1>
                            <v-card class="elevation-0 transparent">
                                <v-card-title primary-title class="layout justify-center">
                                    <div class="headline">Contact us</div>
                                </v-card-title>
                                <v-card-text>
                                    Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                </v-card-text>
                                <v-list class="transparent">
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">phone</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>777-867-5309</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">place</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>Chicago, US</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">email</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>john@vuetifyjs.com</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </v-list>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </section>

            <v-footer class="primary">
                <v-layout row wrap align-center>
                    <v-flex xs12>
                        <div class="white--text ml-3">
                            Made with
                            <v-icon class="red--text">favorite</v-icon>
                            by <a class="white--text" href="https://vuetifyjs.com" target="_blank">Vuetify</a>
                            and <a class="white--text" href="https://github.com/vwxyzjn">Costa Huang</a>
                        </div>
                    </v-flex>
                </v-layout>
            </v-footer>
        </v-content>
    </v-app>
@endsection
