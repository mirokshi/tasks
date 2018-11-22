<?php

use App\Task;
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

Route::middleware('auth:api')->group(function() {
    Route::get('/v1/tasks', 'Api\TasksController@index');                // BROWSE
    Route::get('/v1/tasks/{task}', 'Api\TasksController@show');          // READ
    Route::delete('/v1/tasks/{task}', 'Api\TasksController@destroy');    // DELETE
    Route::post('/v1/tasks', 'Api\TasksController@store');               // CREATE
    Route::put('/v1/tasks/{task}', 'Api\TasksController@update');         // EDIT

//Uncompleted -> ESTADOS
    Route::delete('/v1/completed_task/{task}', 'Api\CompletedTasksController@destroy');
//Complete -> ESTADOS
    Route::post('/v1/completed_task/{task}', 'Api\CompletedTasksController@store');

    //TAGS
    Route::get('/v1/tag', 'Api\TagController@index');                // BROWSE
Route::get('/v1/tag/{tag}', 'Api\TagController@show');          // READ
Route::delete('/v1/tag/{tag}', 'Api\TagController@destroy');    // DELETE
Route::post('/v1/tag', 'Api\TagController@store');               // CREATE
Route::put('/v1/tag/{tag}', 'Api\TagController@update');         // EDIT

//Logged
Route::get('/v1/user/tasks', 'Api\LoggedUserTasksController@index');
Route::post('/v1/user/tasks/{task}', 'Api\LoggedUserTasksController@show');
Route::post('/v1/user/tasks', 'Api\LoggedUserTasksController@store');
Route::delete('/v1/user/tasks/{task}', 'Api\LoggedUserTasksController@destroy');
Route::put('/v1/user/tasks/{task}', 'Api\LoggedUserTasksController@update');

//Users
Route::get('/v1/users', 'Api\UsersController@index');
Route::get('/v1/regular_users', 'Api\RegularUsersController@index');

});
