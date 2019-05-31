<?php

namespace App\Listeners;

use App\Notifications\TaskUpdated;

class SendTaskUpdateNotification
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
        $event->user->notify(new TaskUpdated($event->task,$event->user));
    }
}
