<?php

namespace App\Listeners;

use App\Events\Changelog;
use App\Log;
use App\Task;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;
use Auth;

class LogTaskCompleted implements ShouldQueue
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
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $log = Log::create([
            'text' => "S'ha marcat com a feta la tasca '" . $event->task->name . "'",
            'time' => Carbon::now(),
            'action_type' => 'completar',
            'module_type' => 'Tasques',
            'icon' => 'lock_open',
            'color' => 'primary',
            'user_id' => $event->task['user_id'],
            'loggable_id' => $event->task->id,
            'loggable_type' => Task::class,
            'old_value' => true,
            'new_value' => false,
            //'user' => $event->user
        ]);

        //event(new Changelog($log));
        event(new Changelog($log, $event->user->map()));

    }
}
