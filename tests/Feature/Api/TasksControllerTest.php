<?php


namespace Tests\Feature\Api;


use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase,CanLogin;

    //CRUD -> CRU -> CREATE RETRIEVE UPDATE DELETE
    //BREAD -> PA -> BROWSER READ EDIT ADD DELETE


    //SHOW
    /**
     * @test
     */
    public function manager_can_show_a_task ()
    {
        initialize_roles();
        $user = $this->login('api');
        $user->assignRole('TasksManager');

        // routes/api.php
        //http://tasks.test/api/v1/tasks
        //HTTP -> GET || POST || PUT || PATCH ||DELETE

        //1
        $task = factory(Task::class)->create();

        //2
        $response = $this->json('GET','/api/v1/tasks/'.$task->id);

        //3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($task->name,$result->name);
        $this->assertEquals($task->completed,(boolean) $result->completed);
        $this->assertTrue($user->hasRole('TasksManager'));

    }

    /**
     * @test
     */
    public function regular_user_cannot_show_a_task ()
    {
        $user = $this->login('api');
        $task = factory(Task::class)->create();

        //2
        $response = $this->json('GET','/api/v1/tasks/'.$task->id);

        //3
        $result = json_decode($response->getContent());
        $response->assertStatus(403);

    }

    /**
     * @test
     */
    public function superadmin_can_show_a_task ()
    {
        $user = $this->login('api');
        $user->admin=true;
        $user->save();

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
    public function manager_can_delete_task()
    {
        initialize_roles();
        $user = $this->login('api');
        $user->assignRole('TasksManager');
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
        $this->assertTrue($user->hasRole('TasksManager'));

    }

    /**
     * @test
     */
    public function regular_cannot_delete_task()
    {

        $user = $this->login('api');
        //1
        //Tasks:create()
        $task = factory(Task::class)->create();

        //2
        $response = $this->json('DELETE','/api/v1/tasks/'.$task->id);

        //3
        $result = json_decode($response->getContent());
        $response->assertStatus(403);



    }

    /**
     * @test
     */
    public function superadmin_can_delete_task()
    {

        $user = $this->login('api');
        $user->admin=true;
        $user->save();
        //1
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
        initialize_roles();
        $user = $this->login('api');
        $user->assignRole('TasksManager');
        //Peticiones HTTP es normal, no es XHR -> ajax
//        $response = $this->post('/api/v1/tasks/',[
//            'name' => ''
//        ]);
        //XHR -> JSON

//        Gate::define('task.store',function (){
//           return $user->name =
//        });

        $response = $this->json('POST','/api/v1/tasks/',[
            'name' => ''
        ]);

        $result = json_decode($response->getContent());
        $response->assertStatus(422);
    }


    /**
     * @test
     */
    public function manager_can_create_task()
    {
        initialize_roles();
        $user = $this->login('api');
        $user->assignRole('TasksManager');

        Gate::define('task.store', function ($user){
            $user->givePermissionTo('task.store');
        });

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
    public function regular_user_cannot_create_task()
    {

        $user = $this->login('api');

        $response = $this->json('POST','/api/v1/tasks/',[
            'name' => 'Comprar pan'
        ]);

        $result = json_decode($response->getContent());
        $response->assertStatus(403);

    }

    /**
     * @test
     */
    public function superadmin_can_create_task()
    {
        $user = $this->login('api');
        $user->admin=true;
        $user->save();

        Gate::define('task.store', function ($user){
            $user->givePermissionTo('task.store');
        });

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
    public function manager_can_list_task()
    {
        //1
        initialize_roles();
        $user = $this->login('api');
        $user->assignRole('TasksManager');
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
    public function regular_user_cannot_list_task()
    {

        $user = $this->login('api');
        //1
       create_example_tasks();

        $response = $this->json('GET','/api/v1/tasks');

        $result = json_decode($response->getContent());

        $response->assertStatus(403);

    }

    /**
     * @test
     */
    public function superadmin_user_cannot_list_task()
    {
        $user = $this->login('api');
        $user->admin=true;
        $user->save();
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

    public function manager_can_edit_task()
    {

        // 1
        initialize_roles();
        $user = $this->login('api');
        $user->assignRole('TasksManager');
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
    public function regular_user_can_edit_task()
    {
        // 1
        $user = $this->login('api');
        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar leche'
        ]);

        // 2
        $response = $this->json('PUT','/api/v1/tasks/' . $oldTask->id, [
            'name' => 'Comprar pan'
        ]);

        // 3
        $result = json_decode($response->getContent());
        $response->assertStatus(403);

    }

    /**
     * @test
     */
    public function superadimin_can_edit_task()
    {
        $user = $this->login('api');
        $user->admin=true;
        $user->save();
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
        initialize_roles();
        $user = $this->login('api');
        $user->assignRole('TasksManager');
        $oldTask = factory(Task::class)->create();
        //2
        $response = $this->json('PUT','/api/v1/tasks/' . $oldTask->id, [
            'name' => ''
        ]);
        //3
        $response->assertStatus(422);

    }


}