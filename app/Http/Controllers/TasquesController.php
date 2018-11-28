<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserTasksIndex;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasquesController extends Controller
{
    public function index(UserTasksIndex $request)
    {

        if (Auth::user()->isSuperAdmin() || Auth::user()->hasRole('TasksManager')){
            $tasks = map_collection(Task::orderBy('created_at','desc') -> get());
        }else {
            $tasks = map_collection($request->user()->tasks);
        }
        // MVC
        $users= User::all();
        return view('tasques',compact('tasks', 'users'));
    }
}
