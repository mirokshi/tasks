<?php
namespace Tests\Feature\Api;

use App\Listeners\Task\SendTaskCreateNotification;
use App\Notifications\Task\TaskStored;
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
        $listener = new SendTaskCreateNotification();
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $task->assignUser($user);
        $event = new \App\Events\TaskStore($task);
        Notification::fake();
        $listener->handle($event);

        Notification::assertSentTo(
            $user,
            TaskStored::class,
            function ($notification, $channels) use ($task){
                return $notification->task->id === $task->id;
            }
        );

    }
}
