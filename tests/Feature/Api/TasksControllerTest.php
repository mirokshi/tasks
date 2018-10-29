<?php


namespace Tests\Feature\Api;


use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase;

    //CRUD -> CRU -> CREATE RETRIEVE UPDATE DELETE
    //BREAD -> PA -> BROWSER READ EDIT ADD DELETE


    //SHOW
    /**
     * @test
     */
    public function can_show_a_task ()
    {
//        $this->withoutExceptionHandling();

        // routes/api.php
        //http://tasks.test/api/v1/tasks
        //HTTP -> GET || POST || PUT || PATCH ||DELETE

        //1
        //Tasks:create()
        $task = factory(Task::class)->create();

        //2
        $response = $this->json('GET','/api/v1/tasks/'.$task->id);

        //3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($task->name,$result->name);
        $this->assertEquals($task->completed,(boolean) $result->completed);

    }

    /**
     * @test
     */
    public function can_delete_task()
    {
        //$this->withoutExceptionHandling();
        //1
        //Tasks:create()
        $task = factory(Task::class)->create();

        //2
        $response = $this->json('DELETE','/api/v1/tasks/'.$task->id);

        //3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals('',$result);

    $this->assertDatabaseMissing('tasks', array($task) );

        $this->assertNull(Task::find($task->id));

    }

    /**
     * @test
     */
    public function cannot_create_tasks_whitout_name()
    {
//        $this->withoutExceptionHandling();
        //Peticiones HTTP es normal, no es XHR -> ajax
//        $response = $this->post('/api/v1/tasks/',[
//            'name' => ''
//        ]);
        //XHR -> JSON
        $response = $this->json('POST','/api/v1/tasks/',[
            'name' => ''
        ]);

        $result = json_decode($response->getContent());
        $response->assertStatus(422);
    }


    /**
     * @test
     */
    public function can_create_task()
    {
        //$this->withoutExceptionHandling();

        $response = $this->json('POST','/api/v1/tasks/',[
            'name' => 'Comprar pan'
        ]);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();

//        $this->assertDatabaseHas('tasks', [ 'name' => 'Comprar pan' ]);
        $this->assertNotNull($task = Task::find($result->id));
        $this->assertEquals('Comprar pan',$result->name);
        $this->assertFalse($result->completed);
    }

    /**
     * @test
     */
    public function can_list_task()
    {
        //1
        create_example_tasks();

        $response = $this->json('GET','/api/v1/tasks');
        $response->assertSuccessful();

        $result = json_decode($response->getContent());

        $this->assertCount(3,$result);

        $this->assertEquals('Comprar pan', $result[0]->name);
        $this->assertFalse((boolean)$result[0]->completed);

        $this->assertEquals('Comprar leche', $result[1]->name);
        $this->assertFalse((boolean) $result[1]->completed);

        $this->assertEquals('Estudiar PHP', $result[2]->name);
        $this->assertTrue((boolean) $result[2]->completed);
    }


    /**
     * @test
     */
    public function can_edit_task()
    {

        // 1
        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar leche'
        ]);

        // 2

        $response = $this->json('PUT','/api/v1/tasks/' . $oldTask->id, [
            'name' => 'Comprar pan'
        ]);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();

//        $this->assertDatabaseMissing('tasks', $oldTask);
//        $this->assertDatabaseHas('tasks', $newtask);

        $newTask = $oldTask->refresh();
        $this->assertNotNull($newTask);
        $this->assertEquals('Comprar pan',$result->name);
        $this->assertFalse((boolean) $newTask->completed);
    }

    /**
     * @test
     */
    public function cannot_edit_a_task_whithout_name()
    {

        //1
        $oldTask = factory(Task::class)->create();
        //2
        $response = $this->json('PUT','/api/v1/tasks/' . $oldTask->id, [
            'name' => ''
        ]);
        //3
        $response->assertStatus(422);

    }

}