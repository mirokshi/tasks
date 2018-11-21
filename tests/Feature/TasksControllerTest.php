<?php

//PSR.4
namespace Tests\Feature;

use App\Task;
use App\User;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase,CanLogin;

    /** @test */
    public function can_show_tasks()
    {
//        $this->withoutExceptionHandling();

        //1 Prepare
       create_example_tasks();
        $user = $this->login();
        initialize_roles();
        $user ->assignRole('Tasks');

        //2 execute
        $response = $this -> get('/tasks');
//        dd($responde -> getContent());

        //3 comprovar
        $response->assertSuccessful();
        $response->assertSee('tasks');

        $response->assertSee('Comprar pan');
        $response->assertSee('Comprar leche');
        $response->assertSee('Estudiar PHP');

        //comprovar que se vean las tareas que hay en la BD
        //Base de datos

    }

    /**
     * @test
     */
    public function can_store_task()
    {
        $user = $this->login();
        initialize_roles();
        $user ->assignRole('Tasks');
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
        $user = $this->login();
        initialize_roles();
        $user ->assignRole('Tasks');
        $response = $this->delete('/tasks/1');
        $response->assertStatus(404);

    }

    /**
     * @test
     */
    public function can_delete_task()
    {
        initialize_roles();
        $user = $this->login();
        $user ->assignRole('TasksManager');



        $task = Task::create([
            'name' => 'Comprar leche'
        ]);
        $response = $this->delete('/tasks/' . $task->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('tasks',['name' => 'Comprar leche']);
        $this->assertTrue($user->hasRole('TasksManager'));
    }

    /**
     * @test
     */
    public function can_edit_a_task()
    {
    //1
        initialize_roles();
        $user = $this->login();
        $user ->assignRole('TasksManager');

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
        $task=$task->fresh();
        $this->assertEquals($task->name,'Comprar pan');
        $this->assertEquals($task->completed,true);
        $this->assertTrue($user->hasRole('TasksManager'));
    }


    /**
     * @test
     */
    public function cannot_edit_an_unexisting_tasks()
    {
        initialize_roles();
        $user = $this->login();
        $user ->assignRole('Tasks');
        //TDD -> Test Driven Development
        //1
        //2 execute HTTP request , HTTP response
        $response=$this->put('user/tasks/1',[]);
        $response->assertStatus(404);
        $this->assertTrue($user->hasRole('Tasks'));

    }

    /**
     * @test
     */
    public function cannot_show_edit_form_unexisting_task()
    {

        $user = $this->login();
        initialize_roles();
        $user ->assignRole('Tasks');
        $response = $this->get('user/task_edit/1');
        $response->assertStatus(404);
        $this->assertTrue($user->hasRole('Tasks'));
    }




}
