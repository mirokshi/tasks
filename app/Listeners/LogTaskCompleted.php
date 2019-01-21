<?php

namespace App\Listeners;

use App\Log;
use App\Task;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogTaskCompleted
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
        Log::create([
            'text' => "Se ha marcado como completada '".$event->task->name."'" ,
            'time' =>Carbon::now(),
            'action_type' => 'Completar',
            'module_type'=>'Tasques',
            'icon' => 'lock',
            'color' => 'green',
            'user_id' => $event->task->user_id,
            'loggable_id' => $event-> task->id,
            'loggable_type' => Task::class,
            'old_value' => false,
            'new_value' => true
        ]);
    }
}
