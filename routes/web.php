<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChangelogController;
use App\Http\Controllers\LoggedUserPhotoController;
use App\Http\Controllers\LoggedUserTasksController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TasquesController;

Auth::routes();

//TODO
Route::post('login_alt', 'Auth\LoginAltController@login');
Route::post('register_alt','Auth\RegisterAltController@register');


Route::get('/', function () {
    return view('layouts/landing');
});

//Login with Social's Network
Route::get('/auth/{provider}','\\'.LoginController::class.'@redirectToProvider');
Route::get('/auth/{provider}/callback', '\\'. LoginController::class . '@handleProviderCallback');


//TDD -> TEST DRIVEN DEVELOPMENT

//MIDDLEWARE
//GRUPS_ DE URLS  PARA USUARIOS AUTENTICADOS
Route::middleware(['auth'])->group(function() {


    Route::get('/tasks','\\'. TasksController::class . '@index'); //lista
    Route::post('/tasks','\\'. TasksController::class . '@store'); //crea
    Route::delete('/tasks/{id}','\\'. TasksController::class . '@destroy'); //boora
    Route::put('/tasks/{id}','\\'. TasksController::class . '@update'); //modifica
    Route::get('/task_edit/{id}','TasksController@edit'); //modifica

    //Uncompleted -> ESTADOS
    Route::delete('completed_task/{task}','CompletedTasksController@destroy');

    //Complete -> ESTADOS
    Route::post('/completed_task/{task}','CompletedTasksController@store');

//    Route::patch('/tasks/{id}','TasksController@completed');


//CONTACT
    Route::get('/contact', function (){
        return view('contact');
    });

//ABOUT
    Route::get('/about', function (){
        return view('about');
    });


    //Vue
    Route::get('/tasks_vue','TasksVueController@index');

    //Tasques
    Route::get('/tasques','\\'. TasquesController::class . '@index');
    Route::get('/home', '\\'. TasquesController::class . '@index');

    //Home
//    Route::get('/home','TasksVueController@index');

    //LoggedUserTasksController
    Route::get('/user/tasks','\\'. LoggedUserTasksController::class . '@index');

    //impersonate
    Route::impersonate();

    //Tags
    Route::get('/tags','\\'. TagsController::class . '@index');

    //Profile
    Route::get('/profile', '\\'. ProfileController::class . '@show');

    //Photo
    Route::post('/photo', '\\'. PhotoController::class . '@store');

    //LoggedUserPhoto
    Route::get('/user/photo', '\\'. LoggedUserPhotoController::class . '@show');

    //Changelog
    Route::get('/changelog','\\'. ChangelogController::class . '@index');
});

//WELCOME
Route::get('/welcome', function (){
    return view('welcome');
});


//Auth::logout();



//index -> LIST
//store -> CREATE
//delete -> DESTROY
//edit -> PUT
