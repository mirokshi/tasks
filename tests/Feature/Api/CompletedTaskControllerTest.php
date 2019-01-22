<?php


namespace Tests\Feature\Api;



use App\Events\TaskCompleted;
use App\Events\TaskUncompleted;
use App\Log;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class CompletedTaskControllerTest extends TestCase
{
    use RefreshDatabase,CanLogin;

    /**
     * @test
     */
    public function can_complete_a_task()
    {
        $this->withoutExceptionHandling();
        $this->login('api');
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);
        Event::fake();
        $response = $this->json('POST','/api/v1/completed_task/' . $task->id);
        $response->assertSuccessful();
        $task = $task->fresh();
        $this->assertEquals($task->completed, true);

    }

    /**
     * @test
     */
    public function cannot_complete_a_unexisting_task()
    {
        $this->login('api');
        $response = $this->json('POST','/api/v1/completed_task/1');
        //3 Assert
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_uncomplete_a_task()
    {
        $user = $this->login('api');
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => true
        ]);
        //2

        Event::fake();
        $response = $this->json('DELETE','/api/v1/completed_task/' . $task->id);
        $response->assertSuccessful();
        $task = $task->fresh();
        $this->assertEquals((boolean) $task->completed, false);


        Event::assertDispatched(TaskUncompleted::class, function ($event) use ($task) {
            return $event->task->is($task);
        });
    }

    /**
     * @test
     */
    public function cannot_uncomplete_a_unexisting_task()
    {
        $this->login('api');
        $response= $this->delete('/api/v1/completed_task/1');
        $response->assertStatus(404);
    }

}
