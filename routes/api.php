<?php

use App\Http\Controllers\Api\Changelog\ChangelogController;
use App\Http\Controllers\Api\GitController;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\TasksController;

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

    Route::get('/v1/tasks','\\' . TasksController::class . '@index');                // BROWSE
    Route::get('/v1/tasks/{task}','\\' . TasksController::class . '@show');          // READ
    Route::delete('/v1/tasks/{task}','\\' . TasksController::class . '@destroy');    // DELETE
    Route::post('/v1/tasks','\\' . TasksController::class . '@store');               // CREATE
    Route::put('/v1/tasks/{task}','\\' . TasksController::class . '@update');

//Uncompleted -> ESTADOS
    Route::delete('/v1/completed_task/{task}', 'Api\CompletedTasksController@destroy');
//Complete -> ESTADOS
    Route::post('/v1/completed_task/{task}', 'Api\CompletedTasksController@store');

    //TAGS
    Route::get('/v1/tags','\\'. TagsController::class . '@index');                // BROWSE
    Route::get('/v1/tags/{tag}','\\'. TagsController::class . '@show');          // READ
    Route::delete('/v1/tags/{tag}','\\'. TagsController::class . '@destroy');    // DELETE
    Route::post('/v1/tags','\\'. TagsController::class . '@store');               // CREATE
    Route::put('/v1/tags/{tag}','\\'. TagsController::class . '@update');         // EDIT

//Logged (User Tasks)
Route::get('/v1/user/tasks', 'Api\LoggedUserTasksController@index');
Route::post('/v1/user/tasks/{task}', 'Api\LoggedUserTasksController@show');
Route::post('/v1/user/tasks', 'Api\LoggedUserTasksController@store');
Route::delete('/v1/user/tasks/{task}', 'Api\LoggedUserTasksController@destroy');
Route::put('/v1/user/tasks/{task}', 'Api\LoggedUserTasksController@update');

//Users
Route::get('/v1/users', 'Api\UsersController@index');
Route::get('/v1/regular_users', 'Api\RegularUsersController@index');

//Git
Route::get('/v1/git/info','\\' . GitController::class . '@index');

//Changelog
    Route::get('/v1/changelog','\\' . ChangelogController::class . '@index');
    //    Route::get('/v1/changelog/module/{module}','Tenant\Api\Changelog\ChangelogModuleController@index');
//    Route::get('/v1/changelog/user/{user}','Tenant\Api\Changelog\ChangelogUserController@index');
//    Route::get('/v1/changelog/loggable/{loggable}/{loggableId}','Tenant\Api\Changelog\ChangelogLoggableController@index');
});
