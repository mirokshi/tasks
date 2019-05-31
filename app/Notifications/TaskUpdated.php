<?php

namespace App\Notifications;

use App\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class TaskUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public $task ,$user;

    /**
     * TaskUncompleted constructor.
     * @param $task
     */
    public function __construct($task, $user)
    {
        $this->task = $task;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', WebPushChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => "S'ha editat una tasca: " . $this->task['name'],
            'url' => '/tasques/' . $this->task['id'],
            'icon' => 'assignment',
            'iconColor' => 'primary',
        ];
    }


    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Tasca editada!')
            ->icon('/notification-icon.png')
            ->body('Has editat la tasca: ' . $this->task['name'])
            ->action('Visualitza la tasca', 'open_url')
            ->data(['url' => env('APP_URL') . '/tasques/' . $this->task['id']]);
    }

}
