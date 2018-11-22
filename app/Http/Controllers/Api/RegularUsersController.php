<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestroyTask;
use App\Http\Requests\IndexTask;
use App\Http\Requests\ShowTask;
use App\Http\Requests\UpdateTask;
use App\Http\Requests\StoreTask;
use App\Task;
use App\User;
use Illuminate\Http\Request;


class RegularUsersController extends Controller
{
    public function index(Request $request)
    {
        //Scopes
        return map_collection(User::regular()->get());
    }
}


