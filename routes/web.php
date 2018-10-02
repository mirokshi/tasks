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
Route::post('/tasks','TasksController@store');
Route::delete('/tasks/{id}','TasksController@destroy');
Route::patch('/tasks/{id}','TasksController@update');


//Route::get('/tasks',function (){
//    return view('tasks');
//});


Route::get('/about', function (){
   return view('Welcome');
});

//Route::get('/prueba','PruebaController@show');
Route::get('/prueba', function (){
    $prueba = 'asasas';
   dd($prueba);
});

Route::redirect('/hola','/prueba');