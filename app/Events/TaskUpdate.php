<?php

namespace App\Events;

use App\Task;
use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskUpdate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $oldTask;
    public $task;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($oldTask, Task $task, User $user)
    {
        $this->task = $task;
        $this->oldTask = $oldTask;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return[
            new PrivateChannel('App.User.'.$this->task->user_id),
            new PrivateChannel('Tasques'),
            new PrivateChannel('App.Log')
        ];
    }
}
