<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
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

    }
}
