<?php

namespace App\Listeners;

use App\Events\Changelog;
use App\Log;
use App\Task;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class LogTaskCreate implements ShouldQueue
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
            'text' => "Se ha creado una nueva tarea '".$event->task->name."'" ,
            'time' =>Carbon::now(),
            'action_type' => 'Crear',
            'module_type'=>'Tasques',
            'icon' => 'fiber_new',
            'color' => '#339966',
            'user_id' => Auth::user()->id,
            'loggable_id' => $event-> task->id,
            'loggable_type' => Task::class,
            'new_value' => $event->task->name
        ]);
        event(new Changelog($log,Auth::user()->map()));
    }
}
