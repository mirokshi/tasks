@extends ('layout.app')
@section('title')
    Tasks PHP
     @endsection
@section('content')
{{--LARAVEL BLADE--}}
{{--//CARD--}}

        <v-card grid-list-md text-xs-center >
            <v-toolbar dark>
                <v-toolbar-title>Tasks con PHP</v-toolbar-title>
            </v-toolbar>
            <v-spacer></v-spacer>
            <v-list >
                <v-list-tile-content>
                    {{--CONTENIDO--}}
                    <form action="/tasks" method="POST" class="p-5 pl-5">
                        {{--label--}}
                        @csrf
                        <input name="name" type="text" placeholder="New task" class="elevation-10 ">
                        <button><v-btn color="info">Agregar</v-btn></button>
                    </form>
                    @foreach ($tasks as $task)
                        <v-layout>{{ $task->name }}
                            <button><v-btn color="success"> Completar </v-btn></button>
                            <a href="/task_edit/{{$task->id}}">
                                <button><v-btn color="warning">Modificar</v-btn></button>
                            </a>
                            <form action="/tasks/{{ $task->id }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button><v-btn color="error">Eliminar</v-btn></button>
                            </form>
                        </v-layout>
                            @endforeach
                </v-list-tile-content>
            </v-list>
        </v-card>

@endsection