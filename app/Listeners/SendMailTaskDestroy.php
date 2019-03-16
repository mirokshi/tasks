<?php

namespace App\Listeners;



use App\Mail\TaskDestroy;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendMailTaskDestroy implements ShouldQueue
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
        $user = User::find($event->task['user_id']);
        Mail::to($user)
            ->cc(config('tasks.manager_email'))
            ->send((new TaskDestroy($event->task))->subject("Tarea ". $event->task['name']. " borrada"));
    }
}
