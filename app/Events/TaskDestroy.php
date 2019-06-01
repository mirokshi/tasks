<?php

namespace App\Events;

use App\Task;
use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskDestroy implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $task;
    public $user;
<<<<<<< HEAD
    /**
     * Create a new event instance.
     *
     * @param array $task
     * @param $user
     */
    public function __construct( array $task, $user)
=======


    public function __construct(Task $task, User $user)
>>>>>>> master
    {
        $this->task = $task;
        $this->user = $user;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [
            new PrivateChannel('App.User.'.$this->user->id),
            new PrivateChannel('tasks')
        ];
    }
}
