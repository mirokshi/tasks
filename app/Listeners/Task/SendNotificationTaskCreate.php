<?php

namespace App\Listeners\Task;

use App\Notifications\Task\TaskCreate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationTaskCreate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //Notify::send();
        //$user->notify();
        $event->task->user->notify(new TaskCreate($event->task));
    }
}
