@extends('layout.landing')
@section('title')
    Homepage Tasks
@endsection

@section('content')
    <v-app light  class="grey darken-4 white--text">
<v-toolbar class="grey darken-4 white--text">
    <v-toolbar-title> Homepage Tasks</v-toolbar-title>
    <v-spacer></v-spacer>
    @if(empty(Auth::user()->email))
        <v-btn href="login" class="indigo darken-4 white--text"> LOGIN  </v-btn>
        <v-btn href="register" class="indigo darken-4 white--text"> REGISTER</v-btn>

        {{--<v-btn @click="loginForm = !loginForm">LOGIN</v-btn>--}}
        {{--<v-btn @click="registerForm = !registerForm">REGISTER</v-btn>--}}
        {{--<v-dialog v-model="loginForm" max-width="1000">--}}
            {{--<v-card>--}}
                {{--<login-form email="{{old('email')}}" csrf-token="{{csrf_token()}}"></login-form>--}}
            {{--</v-card>--}}
        {{--</v-dialog>--}}
        {{--<v-dialog v-model="registerForm" max-width="1000">--}}
            {{--<v-card>--}}
                {{--<register-form email="{{old('email')}}" csrf-token="{{csrf_token()}}"></register-form>--}}
            {{--</v-card>--}}

        {{--</v-dialog>--}}
    @else
        <v-form action="/logout" method="POST">
            @csrf
            <v-btn class="indigo darken-4 white--text" type="submit">LOGOUT</v-btn>
        </v-form>
    @endif

</v-toolbar>
<v-content>
    <section>
        <v-parallax src="https://picsum.photos/1000/1000/?random" height="600">
            <v-layout
                    column
                    align-center
                    justify-center
            >
                <h1 class="white--text mb-2 display-1 text-xs-center">Tasks</h1>
                <v-btn
                        class="indigo darken-4 mt-5"
                        dark
                        large
                        href="/home"
                >
                    Get Started
                </v-btn>
            </v-layout>
        </v-parallax>
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
        <v-parallax src="https://placeimg.com/1000/1000/any" height="380">
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

    <v-footer class="blue darken-2">
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
