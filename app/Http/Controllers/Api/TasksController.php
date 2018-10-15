<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;


class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at','desc') -> get();
        return view('tasks', ['tasks' => $tasks]);

    }

    public function show(Request $request, Task $task) //Route Model Binding
    {
        return $task;
//        return Task::findOrFail($request -> task);
    }

    public function destroy(Request $request, Task $task)
    {
        $task->delete();
    }

    //CREATE

    public function store(Request $request)
    {
//        Task::create();
        $task = new Task();
        $task->name = $request->name;
        $task->completed = false;
        $task->save();
        return $task;
    }

    public function edit(Request $request, Task $task)
    {
        $task->name = $request->name;
        $task->save();
        return $task;
    }


}
