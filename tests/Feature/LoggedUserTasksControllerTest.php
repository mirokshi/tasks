<?php

namespace Tests\Feature;


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
    $this->withoutExceptionHandling();
//    $this->withExceptionHandling();
        // 1
        $user = $this->login();
        dump(1);
        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();
        dump(2);
        $tasks = collect([$task1,$task2,$task3]);
        dump(3);
        $user->addTasks($tasks);

        // 2 execute
        $response = $this->get('/user/tasks');
//
//        $response->assertSuccessful();
//        $response->assertViewIs('tasks.user.index');
//
//        $response->assertViewHas('tasks', $user->tasks);


 }
 /**
  * @test
  */
    public function cannot_list_logged_user_tasks_if_user_is_not_logged()
    {
        $this->markTestSkipped();
        //2
        $this->login();
        $response = $this->get('/user/tasks');
        $response -> assertStatus(404);
 }


}
