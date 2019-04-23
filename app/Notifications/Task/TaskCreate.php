<?php

namespace App\Notifications\Task;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskCreate extends Notification implements ShouldQueue
{
    use Queueable;

    public $task;

    /**
     * TaskUncompleted constructor.
     *
     * @param $task
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Se ha creado una nueva tarea: '. $this->task->name,
            'url' =>'/tasks/'.$this->task->id,
            'icon' => 'build',
            'iconColor' => 'accent',
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
