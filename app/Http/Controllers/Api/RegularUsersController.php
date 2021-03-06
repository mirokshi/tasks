<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
