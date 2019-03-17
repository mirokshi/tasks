<?php

namespace App\Listeners;

use App\Log;
use App\Task;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogTaskCreate
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
            'text' => "Se ha creado una nueva tarea '".$event->task->name."'" ,
            'time' =>Carbon::now(),
            'action_type' => 'Crear',
            'module_type'=>'Tasques',
            'icon' => 'fiber_new',
            'color' => '#339966',
            'user_id' => $event->task->user_id,
            'loggable_id' => $event-> task->id,
            'loggable_type' => Task::class,
            'new_value' => $event->task->name
        ]);
    }
}
