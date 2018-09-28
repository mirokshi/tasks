<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tasks</title>
</head>
<body>
<h1>Tasks</h1>
<ul>
@foreach($tasks as $task)
    <li>{{$task->name}} <button>Completed</button> <button>Modificar</button><button>Borrar</button></li>

    @endforeach
</ul>
<form action="/tasks" method="POST">
    @csrf
    <input name="name" type="text" placeholder="new task">
    <button>Add</button>
</form>
</body>
</html>