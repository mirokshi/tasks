<?php

namespace App\Listeners;

use App\Log;
use App\Task;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogTaskDestroy
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
            'text' => "Se ha eliminado la tarea'".$event->task->name."'" ,
            'time' =>Carbon::now(),
            'action_type' => 'Eliminar',
            'module_type'=>'Tasques',
            'icon' => 'delete_forever',
            'color' => '#B40404',
            'user_id' => $event->task->user_id,
            'loggable_id' => $event-> task->id,
            'loggable_type' => Task::class,
            'old_value' => $event->task->name,
            'new_value' => ""
        ]);
    }
}
