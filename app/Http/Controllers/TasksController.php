<?php

namespace App\Http\Controllers;


use App\Http\Requests\TaskDestroy;
use App\Http\Requests\TaskIndex;
use App\Http\Requests\TaskShow;
use App\Http\Requests\TaskUpdate;
use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = map_collection(Task::orderBy('created_at','desc') -> get());
        return view('tasks', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
    Task::create([
        'name'=> $request->name ,
        'completed' => false,
        'user_id' => $request->user_id
    ]);
    //Regresar a /tasks
    return redirect('/tasks');

}

    public function destroy(Request $request) //borra
    {

       $task= Task::findOrFail($request->id);
        $task->delete();
        return redirect()->back();
    }

    public function update(Request $request) //modifica
    {

        $task= Task::findOrFail($request->id);
        $task->name=$request->name;
        $task->completed=true;
        $task->save();
        return redirect('/tasks');

    }
    public function edit(Request $request)
    {
        $task = Task::findOrFail($request->id);
        return view('task_edit',[ 'task' => $task]);

    }

}
