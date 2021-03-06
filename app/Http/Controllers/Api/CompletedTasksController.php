<?php

namespace App\Http\Controllers\Api;

use App\Events\TaskCompleted;
use App\Events\TaskUncompleted;
use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use Auth;

class CompletedTasksController extends Controller
{

    public function destroy(Request $request, Task $task)
    {
        $task->completed = false;
        $task->save();

        //  HOOK -> EVENT
        event(new TaskUncompleted($task,Auth::user()));
        return $task;
    }

    public function store(Request $request, Task $task)
    {
        $task->completed = true;
        $task->save();

        //  HOOK -> EVENT
        event(new TaskCompleted($task,Auth::user()));
        return $task;
    }
}
