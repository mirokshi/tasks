<?php

namespace App\Http\Controllers;


use App\Http\Requests\TaskCompleted;
use App\Http\Requests\TaskUncompleted;
use App\Task;
use Illuminate\Http\Request;

class CompletedTasksController extends Controller
{

    public function store(Request $request, Task $task)
    {
        $task->completed = true;
        $task->save();
        return redirect('/tasks');
}

    public function destroy(Request $request, Task $task)
    {
        $task->completed=false;
        $task->save();
        return redirect()->back();
    }

}
