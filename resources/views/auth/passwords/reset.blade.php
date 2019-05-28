@extends('layouts.login')

@section('title')
    Reset Password
@endsection

@section('content')
    <v-container fluid fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm4>
                <v-card class="elevation-12">
                    <v-toolbar color="primary" dark>
                        <v-toolbar-title>{{ __('Restablecer la contraseña') }}</v-toolbar-title>
                    </v-toolbar>

                    <v-card-text>
                        <v-form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <v-text-field id="email" type="email" class="mb-3"
                                          error-messages="{{ $errors->first('email') }}"
                                          class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                          name="email"
                                          value="{{ $email ?? old('email') }}" placeholder="{{ __('Email') }}"
                                          required
                                          autofocus
                            >
                            </v-text-field>

                            <v-text-field id="password" type="password" class="mb-3"
                                          error-messages="{{ $errors->first('password') }}"
                                          class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                          name="password" required placeholder="{{ __('Contraseña') }}"
                            >

                            </v-text-field>

                            <v-text-field id="password-confirm" type="password" class="mb-3 "
                                          name="password_confirmation" required
                                          placeholder="{{ __('Confirmar Contraseña') }}"
                            ></v-text-field>

                            <v-btn type="submit" class="primary" class="mt-5">
                                {{ __('Restablecer') }}
                            </v-btn>

                        </v-form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
