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

Route::get('tasks','TasksControllers@index');


Route::get('/tasks',function (){
    return view('tasks');
});


Route::get('/about', function (){
   return view('vista');
});

Route::get('/prueba','PruebaController@show');
Route::get('/prueba', function (){
   dd('Hola');
});

Route::redirect('hola','prova');