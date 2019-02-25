<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoggedUserTasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedUserTasksController extends Controller
{
    public function index(LoggedUserTasks $request)
    {
        $uri = '/api/v1/user/tasks';
        $tasks = optional(Auth::user())->tasks;
        return view('tasks.user.index', compact('tasks','uri'));
    }

}
