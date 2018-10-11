@extends ('layout.app')

@section('content')
{{--LARAVEL BLADE--}}
{{--//CARD--}}

        <v-card>
            <v-toolbar color="cyan" dark>

                <v-toolbar-title>Tasks con PHP</v-toolbar-title>

            </v-toolbar>

            <v-list>

                        <v-list-tile-content>
                            {{--CONTENIDO--}}
                            <form action="/tasks" method="POST">
                                {{--label--}}
                                @csrf
                                <input name="name" type="text" placeholder="New task">
                                <button><v-btn color="info">Agregar</v-btn></button>
                            </form>
                            
                            @foreach ($tasks as $task)
                                <div>{{ $task->name }}

                                    <form action="/tasks/{{ $task->id }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button><v-btn color="error" >Eliminar</v-btn></button>
                                    </form>
                                    <button><v-btn color="success"> Completar </v-btn></button>
                                    <button><v-btn color="warning">Modificar</v-btn></button>

                                </div>
                            @endforeach

                        </v-list-tile-content>
            </v-list>
        </v-card>


@endsection