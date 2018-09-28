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

//        dd(Request::input);
        //Request
        //
        Task::create([
            'name'=> $request->name ,
            'completed' => false
        ]);

        return redirect('/tasks');
        //Regresar a /tasks
    }

    public function destroy()
    {
//        dd($request->id);

       $task= Task::findOrFail($request->id);
        $task->delete();

        return redirect()->back();
//        return redirect('/tasks');
    }
}
