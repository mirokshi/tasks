<?php

namespace App\Providers;

use App\Events\TaskCompleted;
use App\Events\TaskStore;
use App\Events\TaskDestroy;
use App\Events\TaskUncompleted;
use App\Events\TaskUpdate;
use App\Listeners\AddRolesToRegisterUser;
use App\Listeners\ForgetTasksCache;
use App\Listeners\LogNotification;
use App\Listeners\LogTaskCompleted;
use App\Listeners\LogTaskDelete;
use App\Listeners\LogTaskStored;
use App\Listeners\LogTaskUncompleted;
use App\Listeners\LogTaskUpdated;
use App\Listeners\SendDatabaseNotificationStore;
use App\Listeners\SendMailTaskCompleted;
use App\Listeners\SendMailTaskCreate;
use App\Listeners\SendMailTaskDestroy;
use App\Listeners\SendMailTaskUncompleted;
use App\Listeners\SendMailTaskUpdate;
use App\Listeners\SendTaskCompletedNotification;
use App\Listeners\SendTaskDeleteNotification;
use App\Listeners\SendTaskStoredNotification;
use App\Listeners\SendTaskUncompletedNotification;
use App\Listeners\SendTaskUpdateNotification;
use Illuminate\Notifications\Events\NotificationSent;
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
            AddRolesToRegisterUser::class,
            ForgetTasksCache::class
        ],
        TaskUncompleted::class => [
            LogTaskUncompleted::class,
            SendMailTaskUncompleted::class,
            ForgetTasksCache::class,
            SendTaskUncompletedNotification::class
        ],
        TaskCompleted::class => [
            LogTaskCompleted::class,
            SendMailTaskCompleted::class,
            ForgetTasksCache::class,
            SendTaskCompletedNotification::class
        ],
        TaskDestroy::class => [
            LogTaskDelete::class,
            SendMailTaskDestroy::class,
            //ForgetTasksCache::class,
            //SendTaskDeleteNotification::class
        ],
        TaskStore::class => [
            LogTaskStored::class,
            SendMailTaskCreate::class,
            ForgetTasksCache::class,
            SendTaskStoredNotification::class,
        ],
        TaskUpdate::class => [
            LogTaskUpdated::class,
            SendMailTaskUpdate::class,
            ForgetTasksCache::class,
            SendTaskUpdateNotification::class
        ],
        NotificationSent::class => [
          LogNotification::class,
          SendDatabaseNotificationStore::class
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
