<?php

namespace App\Providers;

use App\Events\TaskCompleted;
use App\Events\TaskCreate;
use App\Events\TaskDestroy;
use App\Events\TaskUncompleted;
use App\Events\TaskUpdate;
use App\Listeners\AddRolesToRegisterUser;
use App\Listeners\ForgetTasksCache;
use App\Listeners\LogNotification;
use App\Listeners\LogTaskCompleted;
use App\Listeners\LogTaskCreate;
use App\Listeners\LogTaskDestroy;
use App\Listeners\LogTaskUncompleted;
use App\Listeners\LogTaskUpdate;
use App\Listeners\SendDatabaseNotificationStoredNotification;
use App\Listeners\SendMailTaskCompleted;
use App\Listeners\SendMailTaskCreate;
use App\Listeners\SendMailTaskDestroy;
use App\Listeners\SendMailTaskUncompleted;
use App\Listeners\SendMailTaskUpdate;
use App\Listeners\Task\SendNotificationTaskCreate;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            AddRolesToRegisterUser::class
        ],
        TaskUncompleted::class => [
            LogTaskUncompleted::class,
            SendMailTaskUncompleted::class,
            ForgetTasksCache::class
        ],
        TaskCompleted::class => [
            LogTaskCompleted::class,
            SendMailTaskCompleted::class,
            ForgetTasksCache::class
        ],
        TaskDestroy::class => [
            LogTaskDestroy::class,
            SendMailTaskDestroy::class,
            ForgetTasksCache::class
        ],
        TaskCreate::class => [
            SendMailTaskCreate::class,
            ForgetTasksCache::class,
            SendNotificationTaskCreate::class,
            LogTaskCreate::class,
        ],
        TaskUpdate::class => [
            LogTaskUpdate::class,
            SendMailTaskUpdate::class,
            ForgetTasksCache::class,
        ],
        NotificationSent::class => [
          LogNotification::class,
          SendDatabaseNotificationStoredNotification::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
