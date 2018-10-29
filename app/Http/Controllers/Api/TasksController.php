<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTask;
use App\Http\Requests\StoreTask;
use App\Task;
use Illuminate\Http\Request;


class TasksController extends Controller
{
    public function index(Request $request)
    {
        return Task::orderBy('created_at')->get();

    }

    public function show(Request $request, Task $task) //Route Model Binding
    {
        return $task->map();
//        return Task::findOrFail($request -> task);
    }

    public function destroy(Request $request, Task $task)
    {
        $task->delete();
    }

    //CREATE

    public function store(StoreTask $request)
    {
//        Task::create();
        //no if`s -.-
//        $request->validate([
//            'name'=> 'required',
//
//        ]);
        $task = new Task();
        $task->name = $request->name;
        $task->completed = false;
        $task->save();
        return $task->map();
    }

    public function update(UpdateTask $request, Task $task)
    {
        $task->name = $request->name;
        $task->save();
        return $task->map();
    }


}
