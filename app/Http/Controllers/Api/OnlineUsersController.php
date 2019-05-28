<?php

namespace App\Http\Controllers\Api\Users;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

/**
 * Class OnlineUsersController.
 *
 * @package App\Http\Controllers\Tenant\Api\Users
 */
class OnlineUsersController extends Controller
{
    /**
     * Index
     * @param \Request $request
     * @return
     */
    public function index(Request $request)
    {
        return User::online();
    }

}
