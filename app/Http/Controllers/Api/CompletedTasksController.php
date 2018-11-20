<?php


namespace App\Http\Controllers\Api;

use App\Http\Requests\CompletedTask;
use App\Http\Requests\UncompletedTask;
use App\Task;
use Illuminate\Http\Request;

class CompletedTasksController
{

    public function destroy(UncompletedTask $request, Task $task)
    {
        $task->completed=false;
        $task->save();
}

    public function store(CompletedTask $request, Task $task)
    {
        $task->completed = true;
        $task->save();
}
}