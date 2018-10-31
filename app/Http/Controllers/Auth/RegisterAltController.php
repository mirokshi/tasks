<?php
namespace App\Http\Controllers\Auth;


use App\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class RegisterAltController
{
public function register(Request $request)
{

    Auth::login($user);
    return redirect('/home');

}

}