<?php

namespace Tests\Feature\Api;


use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class LoggedUserTasksControllerTest extends TestCase
{
 use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function can_list_logged_user_tasks()
    {

        // 1
         $user = $this->login('api');

        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();

        $tasks = [$task1,$task2,$task3];
        $user->addTasks($tasks);

        // 2 execute
        $response = $this->json('GET','/api/v1/user/tasks');
        $response->assertSuccessful();

        $result = json_decode($response->getContent());

        $this->assertCount(3, $result);

        $this->assertEquals($result[0]->id, $task1->id);
        $this->assertEquals($result[1]->id, $task2->id);
        $this->assertEquals($result[2]->id, $task3->id);

 }
 /**
  * @test
  */
    public function cannot_list_logged_user_tasks_if_user_is_not_logged()
    {
        //2
        $response = $this->json('GET','/user/tasks');
        $response -> assertStatus(401);
 }

    /**
     * @test
     */
    public function cannot_edit_a_task_not_associated_to_user()
    {

        $this->login('api');
        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar llet'
        ]);
        $response = $this->json('PUT', '/api/v1/user/tasks/' . $oldTask->id, [
            'name' => 'Comprar pa'
        ]);
        $response->assertStatus(404);
    }

    /**
     *@test
     */
    public function can_edit_tasks()
    {
        // 1
        $user =$this->login('api');
        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar leche',
            'description' => 'blablabla'
        ]);
        $user ->addTask($oldTask);

        // 2

        $response = $this->json('PUT','/api/v1/user/tasks/' . $oldTask->id, [
            'name' => 'Comprar pan',
            'description' => 'jojojojo'
        ]);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();

        $newTask = $oldTask->refresh();
        $this->assertNotNull($newTask);
        $this->assertEquals('Comprar pan',$result->name);
        $this->assertEquals('jojojojo',$result->description);
        $this->assertFalse((boolean) $newTask->completed);
    }

    /**
     * @test
     */
    public function cannot_delete_not_owned_tasks()
    {
        $user =$this->login('api');

        //1
        $task = factory(Task::class)->create([
            'name' => 'Comprar leche',
            'description' => 'blablabla'
        ]);

        $response = $this->json('DELETE','/api/v1/user/tasks/' . $task->id);

        $response->assertStatus(404);

    }

    /**
     * @test
     */
    public function can_delete_tasks()
    {
        $user =$this->login('api');

        //1
        $task = factory(Task::class)->create([
            'name' => 'Comprar leche',
            'description' => 'blablabla'
        ]);
        $user->addTask($task);
        $response = $this->json('DELETE','/api/v1/user/tasks/' . $task->id);
        $response->assertSuccessful();
        $this->assertCount(0,$user->tasks);
        $task = $task->fresh();

    }

}
