<?php

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase{

    use RefreshDatabase;

    /**
     * @test
     */
    public function user_tasks_return_null_when_no_tasks()
    {
        //1
        $user = factory(User::class)->create();
        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();
        $user-> addTask($task1);
        $user-> addTask($task2);
        $user-> addTask($task3);
        //2
        $tasks = $user->tasks;
        //3
        $this->assertTrue($tasks[0]->is($task1));
        $this->assertTrue($tasks[1]->is($task2));
        $this->assertTrue($tasks[2]->is($task3));
    }
    /**
     * @test
     */
    public function can_add_task_to_user()
    {
        //1
        $user = factory(User::class)->create();
        $task1 = factory(Task::class)->create();
        $user-> addTask($task1);

        //2
        $tasks = $user->tasks;
        //3
        $this->assertTrue($tasks[0]->is($task1));

    }

 /**
  * @test
  */
    public function user_tasks_returns_null_when_no_tasks2()
    {
        $user = factory(User::class)->create();

        $tasks = $user -> task;

        $this->assertEmpty($tasks);
 }

    /**
     * @test
     */
    public function can_add_tasks_to_user()
    {
        //1
        $user = factory(User::class)->create();
        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();

        $tasks = [];
        array_push($tasks,$task1);
        array_push($tasks,$task2);
        array_push($tasks,$task3);

        $user-> addTasks($tasks);

        //2
        $tasks = $user->tasks;
        //3
        $this->assertTrue($tasks[0]->is($task1));
        $this->assertTrue($tasks[1]->is($task2));
        $this->assertTrue($tasks[2]->is($task3));

    }

    /**
     * @test
     */
    public function haveTask()
    {
        //2
        $user->haveTask();
    }

    /**
     * @test
     */
    public function removeTask()
    {
        //2
        $user->removeTask();
    }
}