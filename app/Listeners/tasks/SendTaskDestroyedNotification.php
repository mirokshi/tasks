<?php
namespace App\Listeners\tasks;
use App\Notifications\TaskDeleted;
use Illuminate\Support\Facades\Auth;
class SendTaskDestroyedNotification
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
        if ($event->task->user){
            $user=$event->task->user;
        } else{
            $user=Auth::user();
        }
        $user->notify(new TaskDeleted($event->task));
//        $event->task->user->notify(new TaskDestroyed($event->task));
//        $event->user->notify(new TaskDestroyed($event->task));
    }
}
