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

Route::get('/', function () {
    return view('welcome');
});

//TDD -> TEST DRIVEN DEVELOPMENT

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

//WELCOME
Route::get('/welcome', function (){
    return view('welcome');
});


//Uncompleted -> ESTADOS
Route::delete('completed_task/{task}','CompletedTasksController@destroy');

//Complete -> ESTADOS
Route::post('/completed_task/{task}','CompletedTasksController@store');

Route::get('/tasks_vue','TasksVueController@index');

//index -> LIST
//store -> CREATE
//delete -> DESTROY
//edit -> PUT
