<?php

namespace App\Listeners;

use App\Events\Changelog;
use App\Log;
use App\Task;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class LogTaskUncompleted implements ShouldQueue
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
            'text' => "Se ha marcado como pendiente '".$event->task->name."'" ,
            'time' =>Carbon::now(),
            'action_type' => 'Descompletar',
            'module_type'=>'Tasques',
            'icon' => 'lock_open',
            'color' => 'orange',
            'user_id' => Auth::user()->id,
            'loggable_id' => $event-> task->id,
            'loggable_type' => Task::class,
            'old_value' => true,
            'new_value' => false
        ]);
        event(new Changelog($log,Auth::user()->map()));
    }
}
