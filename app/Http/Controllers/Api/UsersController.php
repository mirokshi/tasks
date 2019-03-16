<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskDestroy;
use App\Http\Requests\TaskShow;
use App\Http\Requests\TaskStore;
use App\Http\Requests\TaskUpdate;
use App\Task;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        return map_collection(User::all());
    }

    public function show(TaskShow $request, Task $task) //Route Model Binding
    {
        return $task->map();
    }

    public function destroy(TaskDestroy $request, Task $task)
    {
        $task->delete();
    }

    //CREATE

    public function store(TaskStore $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->completed = false;
        $task->save();

        return $task->map();
    }

    public function update(TaskUpdate $request, Task $task)
    {
        $task->name = $request->name;
        $task->save();

        return $task->map();
    }
}
