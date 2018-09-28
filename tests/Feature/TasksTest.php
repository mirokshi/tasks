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
    public function can_show_tasks()
    {
//        $this->withoutExceptionHandling();

        //1 Prepare
       Task::create([
           'name' => 'comprar pan',
           'completed' => false
       ]);

        Task::create([
            'name' => 'comprar leche',
            'completed' => true
        ]);

        Task::create([
            'name' => 'estudiar PHP',
            'completed' => true
        ]);


        //2 execute
        $response = $this -> get('/tasks');
//        dd($responde -> getContent());

        //3 comprovar
        $response->assertSuccessful();
        $response->assertSee('tasks');

        $response->assertSee('comprar pan');
        $response->assertSee('comprar leche');
        $response->assertSee('estudiar PHP');

        //comprovar que se vean las tareas que hay en la BD
        //Base de datos

    }

    /**
     * @test
     */
    public function can_store_tasks()
    {
        $this->withoutExceptionHandling();


    $response = $this -> post('/tasks',[
        'name'=> 'Comprar leche'
    ]);

    $response->assertStatus(302);
    $response->assertSuccessful();

    $this->assertDatabaseHas('tasks', ['name' => 'Comprar leche']);

    }

    /**
     * @test
     */
    public function can_delete_taks()
    {
        $this->withoutExceptionHandling();

        $task = Task::create([
            'name' => 'Comprar leche'
        ]);

        $response = $this->delete('/tasks/1');

        $response->assertStatus(302);
        $this->assertDatabaseMissing('tasks',['name'=>'Comprar leche']);

    }

    /**
     * @test
     */
//    public function user_whitout_permissions_can_not_delete_taks()
//    {
//        $response = $this->delete('/tasks/1');
//        $response->assertStatus(404);
//
//    }
}
