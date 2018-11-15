<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedUserTasksController extends Controller
{
    public function index()
    {
//        return Task::where('user_id', Auth::user()->id);
        return Auth::user()->tasks;
    }

    public function store(Request $request)
    {
        $task = Request::create($request->only(['name', 'completed']));
        return Auth::user()->addTask($task);
    }


    public function update(Request $request, Task $task)
    {
        Auth::user()->tasks()->findOrFail($task->id);
        $task->name = $request->name;
        $task->description = $request->description;
        $task->completed = $request->completed;
        $task->save();
        return $task;
    }

    public function destroy(Request $request, Task $task)
    {
        Auth::user()->tasks()->findOrFail($task->id);
        $task->delete();
//        $user->remoTask(); //contrario addTask
    }
}
