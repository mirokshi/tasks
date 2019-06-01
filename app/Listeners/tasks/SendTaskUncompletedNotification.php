<?php

namespace App\Listeners\tasks;

use App\Notifications\TaskUncompleted;
use Illuminate\Support\Facades\Auth;

class SendTaskUncompletedNotification
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
//        dd($event);
        if ($event->task->user){
            $user=$event->task->user;
        } else{
            $user=Auth::user();
        }
        $user->notify(new TaskUncompleted($event->task));
    }
}
