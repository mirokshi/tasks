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
//Route::patch('/tasks/{id}','TasksController@update'); //modifica
Route::put('/tasks/{id}','TasksController@update'); //modifica

//Route::resource() como alternativa



Route::get('/about', function (){
   return view('about');
});

Route::get('/prueba','PruebaController@show');
Route::get('/prueba', function (){
    $prueba = 'asasas';
   dd($prueba);
});

Route::redirect('/hola','/prueba');

//Complete
Route::post('/completed_task','CompletedTaskConttoller@store');
//Uncompleted
Route::delete('/uncompleted_task','CompletedTaskConttoller@destroy');


Route::get('/tasks_vue','TasksVueController@index');

//index -> LIST
//store -> CREATE
//delete -> DESTROY
//edit -> PUT
