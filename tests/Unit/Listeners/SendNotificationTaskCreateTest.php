<?php
namespace Tests\Feature\Api;

use App\Listeners\Task\SendNotificationTaskCreate;
use App\Notifications\Task\TaskCreate;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SendNotificationTaskCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function send_tasks_create_notification()
    {
        $listener = new SendNotificationTaskCreate();
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $task->assignUser($user);
        $event = new \App\Events\TaskCreate($task);
        Notification::fake();
        $listener->handle($event);

        Notification::assertSentTo(
            $user,
            TaskCreate::class,
            function ($notification, $channels) use ($task){
                return $notification->task->id === $task->id;
            }
        );

    }
}
