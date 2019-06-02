<?php

namespace App\Notifications;
use App\Task;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

/**
 * Class TaskStored.
 *
 * @package App\Notifications
 */
class TaskDeleted extends Notification implements ShouldQueue
{
    use Queueable;
    public $task,$user;


    public function __construct($task, User $user)
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
            'title' => "S'ha esborrat una tasca: " . $this->task['name'],
            'url' => '/tasques/' . $this->task['id'],
            'icon' => 'assignment',
            'iconColor' => 'primary',
            'task' => $this->task
        ];
    }


    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Tasca esborrada!')
            ->icon('/notification-icon.png')
            ->body('Has completat la tasca: ' . $this->task['name'])
            ->action('View app', 'view_app')
            ->data(['id' => $notification->id]);
    }
}
