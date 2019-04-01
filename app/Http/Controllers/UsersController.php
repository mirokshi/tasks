<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = map_collection(User::all());
        return view('users',compact('users'));
    }
}
