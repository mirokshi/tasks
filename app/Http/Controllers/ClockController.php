<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class ClockController extends Controller
{
    public function index(Request $request)
    {
        return view('clock.index');
    }
}
