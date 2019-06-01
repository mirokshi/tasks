<?php

namespace App\Listeners;

use App\Events\Changelog;
use App\Log;
use App\Task;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogTaskUpdated implements ShouldQueue
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
            'text' => "S'ha actualitzat la tasca '" . $event->oldTask['name'] . "'",
            'time' => Carbon::now(),
            'action_type' => 'update',
            'module_type' => 'Tasques',
            'icon' => 'update',
            'color' => 'secondary',
            'user_id' => $event->task['user_id'],
            'loggable_id' => $event->task['id'],
            'loggable_type' => Task::class,
            'old_value' => json_encode($event->task->mapSimple()),
            'new_value' => json_encode($event->oldTask),
            //'user' => $event->user
        ]);

        //event(new Changelog($log));
        event(new Changelog($log, $event->user->map()));

    }
}
