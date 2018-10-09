@extends ('layout.app')

@section('content')

<h1>Tasks</h1>
{{--LARAVEL BLADE--}}
<ul>
    @foreach ($tasks as $task)
        <li>{{ $task->name }}  <button>Completar</button>
            <form action="/tasks/{{ $task->id }}" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <button>Eliminar</button>
            </form>
             <button>Modificar</button>
            </form>
        </li>
    @endforeach
</ul>
<form action="/tasks" method="POST">
    {{--label--}}
    @csrf
    <input name="name" type="text" placeholder="New task">
    <button>Agregar</button>
</form>