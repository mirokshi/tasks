<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ForgetTasksCacheTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_forget_tasks_key()
    {
            $listener =new \App\Listeners\ForgetTasksCache();
            $task= factory(\App\Task::class)->create();

           //3 Assert
        \Illuminate\Support\Facades\Cache::shouldReceive('forget')
            ->once()
            ->with(\App\Task::TASKS_CACHE_KEY);

        $listener->handle(new \App\Events\TaskUncompleted($task));

    }

}

