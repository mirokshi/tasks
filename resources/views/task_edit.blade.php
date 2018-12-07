@extends('layout.app')
@section('title')
    Editar tasca
@endsection

@section('content')

            <v-card>
                <v-card-title primary-title>
                    <div>
                        <h3 class="headline mb-0">EDITAR UNA TAREA</h3>
                    </div>
                </v-card-title>
                <v-card-text>
                    <form action="/tasks/{{$task['id']}}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <h5>NOMBRE</h5>
                        <input name="name" type="text" value="{{$task['name']}}">

                        <h5>COMPLETAR</h5>

                        @if ( $task['completed'] )
                            <input name="completed" type="checkbox" checked>
                        @else
                            <input name="completed" type="checkbox">
                        @endif

                        <div class="text-xs-center">
                            <button>
                                <v-btn color="success">
                                    <v-icon class="mr-1" >save</v-icon>
                                    Agregar
                                </v-btn>
                            </button>
                        </div>
                    </form>

                </v-card-text>
            </v-card>
@endsection

