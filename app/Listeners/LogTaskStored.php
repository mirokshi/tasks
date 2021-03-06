<?php

namespace App\Listeners;

use App\Events\Changelog;
use App\Log;
use App\Task;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogTaskStored implements ShouldQueue
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
        $log = Log::create([
            'text' => "S'ha creat la tasca '" . $event->task['name'] . "'",
            'time' => Carbon::now(),
            'action_type' => 'store',
            'module_type' => 'Tasques',
            'icon' => 'note_add',
            'color' => 'success',
            'user_id' => $event->task['user_id'],
            'loggable_id' => $event->task['id'],
            'loggable_type' => Task::class,
            'old_value' => null,
            'new_value' => $event->task,
            //'user' => $event->user
        ]);

        //event(new Changelog($log));
        event(new Changelog($log, $event->user->map()));

    }
}
