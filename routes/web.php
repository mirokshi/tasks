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
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ChangelogController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClockController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LoggedUserPhotoController;
use App\Http\Controllers\LoggedUserTasksController;
use App\Http\Controllers\NewslettersController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PushSubscriptionController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TasquesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VideoController;

Auth::routes(['verify' => true]);

//TODO
Route::post('login_alt', 'Auth\LoginAltController@login');
Route::post('register_alt','Auth\RegisterAltController@register');



Route::get('/', function () {
    return view('welcome');
});

//Login with Social's Network
Route::get('/auth/{provider}','\\'.LoginController::class.'@redirectToProvider');
Route::get('/auth/{provider}/callback', '\\'. LoginController::class . '@handleProviderCallback');


//TDD -> TEST DRIVEN DEVELOPMENT

//MIDDLEWARE
//GRUPS_ DE URLS  PARA USUARIOS AUTENTICADOS
Route::middleware(['auth'])->group(function() {

    //impersonate
    Route::impersonate();
    Route::get('/tasks','\\'. TasksController::class . '@index'); //lista
    Route::post('/tasks','\\'. TasksController::class . '@store'); //crea
    Route::delete('/tasks/{id}','\\'. TasksController::class . '@destroy'); //boora
    Route::put('/tasks/{id}','\\'. TasksController::class . '@update'); //modifica
    Route::get('/task_edit/{id}','\\'.TasksController::class.'@edit'); //modifica
    //Uncompleted -> ESTADOS
    Route::delete('completed_task/{task}','CompletedTasksController@destroy');
    //Complete -> ESTADOS
    Route::post('/completed_task/{task}','CompletedTasksController@store');
    //CONTACT
    Route::get('/contact', function (){
        return view('contact');
    });
    //ABOUT
    Route::get('/about', function (){
        return view('about');
    });
    //Mobile
    Route::get('/mobile', function (){
        return view('mobile');
    });
    //Vue
    Route::get('/tasks_vue','TasksVueController@index');
    //Tasques
    Route::get('/tasques','\\'. TasquesController::class . '@index');
    Route::get('/tasques/{id}','\\'.TasquesController::class.'@show');
    Route::get('/home', '\\'. TasquesController::class . '@index');
    //LoggedUserTasksController
    Route::get('/user/tasks','\\'. LoggedUserTasksController::class . '@index');
    //Tags
    Route::get('/tags','\\'. TagsController::class . '@index');
    //Profile
    Route::get('/profile', '\\'. ProfileController::class . '@show');
    //Photo
    Route::post('/photo', '\\'. PhotoController::class . '@store');
    //Avatar
    Route::post('/avatar', '\\'. AvatarController::class . '@store');
    //LoggedUserPhoto
    Route::get('/user/photo', '\\'. LoggedUserPhotoController::class . '@show');
    //Changelog
    Route::get('/changelog','\\'. ChangelogController::class . '@index');
    Route::get('/notifications', '\\' . NotificationController::class . '@index');
    Route::get('/clock','\\'.ClockController::class.'@index');
    Route::get('/chat', '\\' . ChatController::class . '@index');
    Route::get('/xat', '\\' . ChatController::class . '@index');
    Route::get('/users','\\'.UsersController::class.'@index');
    Route::get('/game','\\'.GameController::class.'@index');
    Route::get('/video','\\'.VideoController::class.'@index');

    // Push Subscriptions
    Route::post('subscriptions', '\\'.PushSubscriptionController::class.'@update');
    Route::post('subscriptions/delete', '\\'.PushSubscriptionController::class.'@destroy');


});

//Newsletters
Route::get('/newsletters', '\\' . NewslettersController::class . '@index');

//WELCOME
Route::get('/welcome', function (){
    return view('welcome');
});

Route::get('/prueba_cola',function (){
 \App\Jobs\SleepJob::dispatch();
});

Route::get('/omplir', function () {
    //10 000
    for ($i =1; $i <=50; $i++){
        factory(App\Task::class)->create();
    }
});

//Auth::logout();

//index -> LIST
//store -> CREATE
//delete -> DESTROY
//edit -> PUT
