<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompletedTask;
use App\Http\Requests\UncompletedTask;
use App\Task;
use Illuminate\Http\Request;

class CompletedTasksController extends Controller
{

    public function store(CompletedTask $request, Task $task)
    {
        $task->completed = true;
        $task->save();
        return redirect('/tasks');
}

    public function destroy(UncompletedTask $request, Task $task)
    {
        $task->completed=false;
        $task->save();
        return redirect()->back();
    }

}