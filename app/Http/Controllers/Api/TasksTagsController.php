<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TasksTagsUpdate;
use App\Tag;
use App\Task;

class TasksTagsController extends Controller
{
    public function update(TasksTagsUpdate $request, Task $task)
    {
        $mappedTags =  collect($request->tags)->map(function ($tag) {
           if (is_int($tag)) {
               return $tag;
           } else {
               return Tag::create([
                   'color'          => 'grey',
                   'name'           => $tag,
                   'description'    => ''
               ])->id;
           }
        });
        $task->addTags(Tag::find($mappedTags));
    }
}
