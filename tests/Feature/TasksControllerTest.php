<?php

//PSR.4
namespace Tests\Feature;

use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksControllerTest extends TestCase
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
    public function can_store_task()
    {
      //  $this->withoutExceptionHandling();


    $response = $this -> post('/tasks',[
        'name'=> 'Comprar leche'
    ]);

    $response->assertStatus(302);
    //$response->assertSuccessful();

    $this->assertDatabaseHas('tasks', ['name' => 'Comprar leche']);

    }
    /**
     * @test
     */
    public function user_whitout_permissions_can_not_delete_tasks()
    {
        $response = $this->delete('/tasks/1');
        $response->assertStatus(404);

    }

    /**
     * @test
     */
//    public function user_without_permissions_cannnot_delete_tasks()
//    {
//        $response = $this->delete('/tasks/1');
//        $response->assertStatus(403);
//    }


    /**
     * @test
     */
    public function can_delete_taks()
    {
        $this->markTestSkipped();
        $this->withoutExceptionHandling();

        $task = Task::create([
            'name' => 'Comprar leche'
        ]);

        $response = $this->delete('/tasks/',$task->id);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('tasks',['name'=>'Comprar leche']);
    }

    /**
     * @test
     */
    public function can_edit_a_task()
    {
    //1
        $task = Task::create([
           'name'=>'Comprar leche',
           'completed'=>false
        ]);
        //2
        $response = $this->put('/tasks/'.$task->id,$newTask=[
            'name'=>'Comprar pan',
            'completed'=>true
        ]);
        $response->assertStatus(302);

        //2options

//        $this->assertDatabaseHas('tasks',$newTask);
//        $this->assertDatabaseMissing('tasks', $task);

        $task=$task->fresh();
        $this->assertEquals($task->name,'Comprar pan');
        $this->assertEquals($task->completed,true);
    }


    /**
     * @test
     */
    public function cannot_edit_an_unexisting_tasks()
    {
$this->markTestSkipped();
//        $this->withoutExceptionHandling();
        //TDD -> Test Driven Development
        //1
        //2 execute HTTP request , HTTP response
        $response=$this->put('/tasks/1',[]);
        $response->$this->assertStatus(404);

    }

    /**
     * @test
     */
    public function cannot_show_edit_form_unexisting_task()
    {
//        $this->withoutExceptionHandling();
        $response = $this->get('/task_edit/1');
        $response->assertStatus(404);
    }


}
