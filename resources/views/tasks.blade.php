@extends ('layout.app')
@section('title')
    Tasks PHP
     @endsection
@section('content')
{{--LARAVEL BLADE--}}
{{--//CARD--}}
<v-container fluid>
    <v-toolbar color="grey darken-3">
        <v-toolbar-title class="white--text">Tasks con PHP</v-toolbar-title>
    </v-toolbar>
<v-card>
    <v-list>
        <v-list-tile-content>
            @foreach ($tasks as $task)
                <v-layout>
                    <v-list-tile-avatar>
                        <img src="https://placeimg.com/100/100/any">
                    </v-list-tile-avatar>
                        {{ $task['name'] }}
                    <form action="/completed_task/{{ $task['id'] }}" method="POST">
                        @csrf
                        <button><v-btn color="success">Completar</v-btn></button>
                    </form>
                    <a href="/task_edit/{{ $task['id'] }}">
                        <button><v-btn color="warning">Modificar</v-btn></button>
                    </a>
                    <form action="/tasks/{{ $task['id'] }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button><v-btn color="error">Eliminar</v-btn></button>
                    </form>
                </v-layout>
            @endforeach
            <form action="/tasks" method="POST">
                @csrf
                <input name="name" type="text" placeholder="New task">
                <button><v-btn color="info">Agregar</v-btn></button>
            </form>
        </v-list-tile-content>
    </v-list>
</v-card>
</v-container>
@endsection