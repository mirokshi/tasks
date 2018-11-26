<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyTask;
use App\Http\Requests\ShowTask;
use App\Http\Requests\UpdateTask;
use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = map_collection(Task::orderBy('created_at','desc') -> get());
        return view('tasks', ['tasks' => $tasks]);
    }

    public function store(ShowTask $request)
    {
    Task::create([
        'name'=> $request->name ,
        'completed' => false
    ]);
    //Regresar a /tasks
    return redirect('/tasks');

}

    public function destroy(DestroyTask $request) //borra
    {

       $task= Task::findOrFail($request->id);
        $task->delete();
        return redirect()->back();
    }

    public function update(UpdateTask $request) //modifica
    {

        $task= Task::findOrFail($request->id);
        $task->name=$request->name;
        $task->completed=true;
        $task->save();
        return redirect('/tasks');

    }
    public function edit(UpdateTask $request)
    {
        $task = Task::findOrFail($request->id);
        return view('task_edit',[ 'task' => $task]);

    }

//    public function completed(Request $request, Task $task)
//    {
//        $task = Task::findorfail($request->id);
//        if ($task->completed == true){
//            $task->completed = false;
//        }else{
//            $task->completed = true;
//        }
//        $task->save();
//        return redirect('/tasks');
//
//    }

}
