<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('tasks', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
    Task::create([
        'name'=> $request->name ,
        'completed' => false
    ]);
    //Regresar a /tasks
    return redirect('/tasks');

}

    public function destroy(Request $request) //borra
    {
//        dd($request->id);
       $task= Task::findOrFail($request->id);
        $task->delete();
//        return redirect('/tasks');
        return redirect()->back();
    }

    public function update(Request $request) //modifica
    {
//        dd($request->id);
        //Modelos->Eloquent ->ORM (HIBERNATE de Java) Object Relational Model
//        Task::find($request->id);
//        if (!Task::find($request->id)) return response(404,'No encontrado');

        $task= Task::findOrFail($request->id);
        $task->name=$request->name;
        $task->completed=true;

        $task->save();
        return $task;

    }


}
