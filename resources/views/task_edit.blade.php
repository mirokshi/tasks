@extends('layout.app')

@section('content')
    <h1>Edit  task</h1>
    <form action="/tasks/{{$task->id}}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        Name: <input name="name" type="text" value="{{$task->name}}">
        {{--// CHECKBOX--}}
        Completed:
        @if ( $task->completed )
            <input name="completed" type="checkbox" checked>
        @else
            <input name="completed" type="checkbox">
        @endif
        <button>Editar</button>
    </form>
@endsection

