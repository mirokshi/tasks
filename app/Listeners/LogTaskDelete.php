<?php

namespace App\Listeners;

use App\Events\Changelog;
use App\Log;
use App\Task;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogTaskDelete implements ShouldQueue
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
            'text' => "S'ha esborrat la tasca '" . $event->task['name'] . "'",
            'time' => Carbon::now(),
            'action_type' => 'delete',
            'module_type' => 'Tasks',
            'icon' => 'delete',
            'color' => 'error',
            'user_id' => $event->task->user_id,
            'loggable_id' => $event->task->id,
            'loggable_type' => Task::class,
            'old_value' => json_encode($event->task),
            'new_value' => null,
            //'user' => $event->user
        ]);
        //event(new Changelog($log));
        event(new Changelog($log, $event->user->map()));

    }
}