<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CompletedTaskControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function can_complete_a_task()
    {
        $this->withoutExceptionHandling();
        $task= Task::create([
            'name' => 'comprar pan',
            'completed' => false
        ]);
        //2
        $response = $this->post('/completed_task/' . $task->id);


        $task = $task->fresh();
        $response->assertRedirect('/tasks');
        $response->assertStatus(302);
        $this->assertEquals($task->completed, true);
    }

    /**
     * @test
     */
    public function cannot_complete_a_unexisting_task()
    {

        $response = $this->json('POST','/completed_task/1');
        //3 Assert
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_uncomplete_a_task()
    {
$this->withoutExceptionHandling();
        //1
        $task= Task::create([
            'name' => 'comprar pan',
            'completed' => true
        ]);
        //2
        $response = $this->json('DELETE','/api/v1/completed_task/' . $task->id);
        $response->assertSuccessful();

        $task = $task->fresh();
        $this->assertEquals((boolean)$task->completed, false);
    }

    /**
     * @test
     */
    public function cannot_uncomplete_a_unexisting_task()
    {

        // 1 -> no cal fer res
        // 2 Execute
        $response= $this->delete('/completed_task/1');
        //3 Assert
        $response->assertStatus(404);
    }
}