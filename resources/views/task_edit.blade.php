@extends('layouts.app')
@section('title')
    Editar tarea
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
                        NOMBRE :
                        <input name="name" type="text" value="{{$task['name']}}">
                        COMPLETAR
                        @if ( $task['completed'] )
                            <input name="completed" type="checkbox" checked>
                        @else
                            <input name="completed" type="checkbox">
                        @endif
                        <div class="text-xs-center">
                            <button>
                                <v-btn color="success">
                                  EDITAR
                                </v-btn>
                            </button>
                        </div>
                    </form>

                </v-card-text>
            </v-card>
@endsection

