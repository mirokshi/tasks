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


Auth::routes();

//TODO
Route::post('login_alt', 'Auth\LoginAltController@login');
Route::post('register_alt','Auth\RegisterAltController@register');


Route::get('/', function () {
    return view('landing');
});

//TDD -> TEST DRIVEN DEVELOPMENT

//MIDDLEWARE
//GRUPS_ DE URLS  PARA USUARIOS AUTENTICADOS
Route::middleware(['auth'])->group(function() {

Route::get('/tasks','TasksController@index'); //muestra
Route::post('/tasks','TasksController@store'); //agrega
Route::delete('/tasks/{id}','TasksController@destroy'); //borra
Route::put('/tasks/{id}','TasksController@update'); //modifica
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
    Route::get('/tasques','TasquesController@index');

    //Home
    Route::get('/home','TasquesController@index');

    //LoggedUserTasksController
    Route::get('/user/tasks','LoggedUserTasksController@index');

    //impersonate
    Route::impersonate();

    //Tags
    Route::get('/tags','TagsController@index');
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
