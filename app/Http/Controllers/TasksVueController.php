<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasksVueController extends Controller
{
    public function index()
    {
        //MVC
        $tasks = Task::all();
//        $tasks = null;
        return view('tasks_vue',
            compact('tasks'));

    }
}
