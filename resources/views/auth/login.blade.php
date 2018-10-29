@extends('layout.login')
@section('title')
    Login
@endsection

@section('content')
    <v-app id="inspire">
        @if($errors->any())
            <v-alert
                    :value="true"
                    type="error"
            >
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{$error}}</li>
                    @endforeach
                </ul>
            </v-alert>
        @endif

        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <v-form action="/login" method="POST">
                        <v-card class="elevation-12">
                            <v-toolbar dark color="primary">
                                <v-toolbar-title>Login form</v-toolbar-title>
                                <v-spacer></v-spacer>
                            </v-toolbar>
                            <v-card-text>
                                    @csrf
                                    <v-text-field prepend-icon="person" name="email" label="Login" type="text" value="{{old('email')}}"></v-text-field>
                                    <v-text-field id="password" prepend-icon="lock" name="password" label="Password" type="password"></v-text-field>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="primary" type="submit">Login</v-btn>
                            </v-card-actions>
                        </v-card>
                        </v-form>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
    </v-app>

@endsection
