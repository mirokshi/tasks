<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\TaskCompleted;
use App\Http\Requests\TaskUncompleted;
use App\Task;
use Illuminate\Http\Request;

class CompletedTasksController extends Controller
{

    public function destroy(Request $request, Task $task)
    {
        $task->completed=false;
        $task->save();
}

    public function store(Request $request, Task $task)
    {
        $task->completed = true;
        $task->save();
}
}
