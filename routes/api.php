<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route:get('/v1/tasks', function (){
//   return [
//    {
//        'name' => 'Compar pan',
//        'completed' => false
//    },
//    {
//        'name' => 'Compar leche',
//        'completed' => false
//    },
//    {
//        'name' => 'Compar lejia',
//        'completed' => false
//    }
//   ]
    return Task::all();
});