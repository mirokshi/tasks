<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskDestroy;
use App\Http\Requests\TaskIndex;
use App\Http\Requests\TaskShow;
use App\Http\Requests\TaskStore;
use App\Http\Requests\TaskUpdate;
use App\Task;
use Illuminate\Http\Request;


class TasksController extends Controller
{
    public function index(TaskIndex $request)
    {
        return map_collection(Task::orderBy('created_at','desc')->get());

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
        $task->user_id = $request->user_id;
        $task->user_gravatar = $request->user_gravatar;
        $task->save();
        return $task->map();
    }

    public function update(TaskUpdate $request, Task $task)
    {
        $task->name = $request->name;
        $task->save();
        return $task->map();
    }

    public function edit(TaskUpdate $request)
    {
        $task = Task::findOrFail($request->id);
        return view('task_edit',[ 'task' => $task]);

    }


}
