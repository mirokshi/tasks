<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskDestroy;
use App\Http\Requests\TaskIndex;
use App\Http\Requests\TaskShow;
use App\Http\Requests\TaskStore;
use App\Http\Requests\TaskUpdate;
use App\Task;
use Auth;

class TasksController extends Controller
{
    public function index(TaskIndex $request)
    {
        return map_collection(Task::orderBy('created_at', 'desc')->get());
    }

    public function show(TaskShow $request, Task $task) //Route Model Binding
    {
        return $task->map();
    }

    //CREATE

    public function store(TaskStore $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->completed = $request->completed ? true : false;
        $task->description = $request->description;
        $task->user_id = $request->user_id;
        $task->save();
        //  HOOK -> EVENT
        event(new \App\Events\TaskStore($task, Auth::user()));

        return $task->map();
    }

    public function destroy(TaskDestroy $request, Task $task)
    {
        $task_old = $task->mapSimple();
        $task->delete();

        //  HOOK -> EVENT
        event(new \App\Events\TaskDestroy($task_old, Auth::user()));
        return $task_old;
    }

    public function update(TaskUpdate $request, Task $task)
    {
        $taskOld = $task;
        $task->name = $request->name;
        $task->completed = $request->completed;
        $task->description = $request->description ?? $task->description;
        $task->user_id = $request->user_id;
        $task->save();

        //  HOOK -> EVENT
        event(new \App\Events\TaskUpdate($taskOld,$task,Auth::user()));

        return $task->map();
    }
}
