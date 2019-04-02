<?php

namespace App\Listeners;

use App\Notifications\DatabaseNotificationStored;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDatabaseNotificationStoredNotification
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
        if ($event->channel === 'database')
        {
            $event->notifiable->notify(new DatabaseNotificationStored($event->notification));
        }
    }
}
