<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        return view('video.index');
    }
}
