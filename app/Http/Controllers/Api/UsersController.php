<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskDestroy;
use App\Http\Requests\TaskShow;
use App\Http\Requests\TaskStore;
use App\Http\Requests\TaskUpdate;
use App\Task;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        return map_collection(User::all());
    }

}
