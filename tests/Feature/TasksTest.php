<?php

//PSR.4
namespace Tests\Feature;

use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function todo()
    {
        $this->withoutExceptionHandling();

        //1 Prepare
       Task::create([
           'name' => 'comprar pan',
           'completed' => false
       ]);




        //2 execute
        $response = $this -> get('/tasks');
//        dd($responde -> getContent());

        //3 comprovar
        $response->assertSuccessful();
        $response->assertSee('tasks');

        //comprovar que se vean las tareas que hay en la BD
        //Base de datos

    }
}
