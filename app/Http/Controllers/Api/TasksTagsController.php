<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TasksTagsUpdate;
use App\Tag;
use App\Task;
use Illuminate\Http\Request;


class TasksTagsController extends Controller{

    public function update(TasksTagsUpdate $request, Task $task)
    {
        $tags=Tag::find($request->tags);
        $task->addTags($tags);
    }
}
