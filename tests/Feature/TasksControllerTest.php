<?php

//PSR.4
namespace Tests\Feature;

use App\Task;
use App\User;
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

        $this->login();

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
        $this->login();
    //1
    $response = $this -> post('/tasks',[
        'name'=> 'Comprar leche'
    ]);



    //2
    $response->assertStatus(302);

    //3
    $this->assertDatabaseHas('tasks', ['name' => 'Comprar leche']);

    }
    /**
     * @test
     */
    public function user_whitout_permissions_can_not_delete_tasks()
    {
        $this->login();
        $response = $this->delete('/tasks/1');
        $response->assertStatus(404);

    }



    /**
     * @test
     */
    public function can_delete_taks()
    {
        $this->login();

        $task = Task::create([
            'name' => 'Comprar leche'
        ]);

        $response = $this->delete('/tasks/'.$task->id);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('tasks',['name'=>'Comprar leche']);
    }

    /**
     * @test
     */
    public function can_edit_a_task()
    {
    //1
        $this->login();

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
        $this->login();

        //TDD -> Test Driven Development
        //1
        //2 execute HTTP request , HTTP response
        $response=$this->put('/tasks/1',[]);
        $response->assertStatus(404);

    }

    /**
     * @test
     */
    public function cannot_show_edit_form_unexisting_task()
    {
        $this->login();
        $response = $this->get('/task_edit/1');
        $response->assertStatus(404);
    }

    public function login(): void
    {
        $user = factory(User::class)->create();
        $this->actingAs($user); //web
        //        $this->actingAs($user, 'api'); //api
    }


}
