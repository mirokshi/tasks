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

Route::get('/tasks','TasksController@index');
Route::post('/tasks','TasksController@store'); //agrega
Route::delete('/tasks/{id}','TasksController@destroy'); //borra
Route::put('/tasks/{id}','TasksController@update'); //modifica

//MODFICAR
    Route::get('/task_edit/{id}','TasksController@edit');

//CONTACT
    Route::get('/contact', function (){
        return view('contact');
    });

//ABOUT
    Route::get('/about', function (){
        return view('about');
    });

    //Uncompleted -> ESTADOS
    Route::delete('completed_task/{task}','CompletedTasksController@destroy');

    //Complete -> ESTADOS
    Route::post('/completed_task/{task}','CompletedTasksController@store');

    //Vue
    Route::get('/tasks_vue','TasksVueController@index');

    //Tasques
    Route::get('/tasques','TasquesController@index');

    //Home Vue
    Route::get('/home','TasksVueController@index');


    //LoggedUserTasksController
    Route::get('/user/tasks','LoggedUserTasksController@index');

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
