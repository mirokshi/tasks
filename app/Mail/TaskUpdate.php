<?php

namespace App\Mail;

use App\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $task, $oldTask;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($oldTask,Task $task)
    {
        $this->oldTask = $oldTask;
        $this->task =  $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.tasks.update');
    }
}
