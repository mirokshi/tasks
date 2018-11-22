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
        $this->markTestSkipped();
        //1
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        //2
        $user->haveTask();

        //3
    }

    /**
     * @test
     */
    public function removeTask()
    {
        $this->markTestSkipped();
        //2
        $user->removeTask();
    }

    /**
     * @test
     */
    public function isSuperAdmin()
    {
        $user = factory(User::class)->create();

        $this->assertFalse($user->isSuperAdmin());
        $user->admin = true;
        $user->save();
        $this->assertTrue($user->isSuperAdmin());
    }

    /**
     * @test
     */
    public function map()
    {
        $user = factory(User::class)->create([
           'name' => 'Pepe Pardo Jeans',
           'email' => 'pepepardo@jeans.com'
        ]);

        $mappedUser = $user->map();

        $this->assertEquals($mappedUser['name'], 'Pepe Pardo Jeans');
        $this->assertEquals($mappedUser['email'], 'pepepardo@jeans.com');
        $this->assertEquals($mappedUser['avatar'], 'https://www.avatar.com/avatar/6849ef9c40c2540dc23ad9699a79a2f8');

    }

    /**
     * @test
     */
    public function regulars()
    {

        $this->assertCount(0,User::regular()->get());
        $user1 = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);
        $user2 = factory(User::class)->create([
            'name' => 'Pepa Parda Jeans',
            'email' => 'pepaparda@jeans.com'
        ]);
        $user3 = factory(User::class)->create([
            'name' => 'Pepa Pig',
            'email' => 'pepapig@dibus.com'
        ]);
        $user3->admin = true;
        $user3->save();
        $this->assertCount(2,$regularusers = User::regular()->get());
        $this->assertEquals($regularusers[0]->name,'Pepe Pardo Jeans');
        $this->assertEquals($regularusers[1]->name, 'Pepa Parda Jeans');
    }
}
