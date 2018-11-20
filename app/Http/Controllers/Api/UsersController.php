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


class UsersController extends Controller
{
    public function index(Request $request)
    {
        return map_collection(User::all());
    }

    public function show(ShowTask $request, Task $task) //Route Model Binding
    {
        return $task->map();
    }

    public function destroy(DestroyTask $request, Task $task)
    {
        $task->delete();
    }

    //CREATE

    public function store(StoreTask $request)
    {

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
