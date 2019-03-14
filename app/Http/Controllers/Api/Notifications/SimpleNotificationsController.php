<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notifications\SimpleNotificationsStore;
use App\Http\Requests\Notifications\UserNotificationsIndex;
use App\Notifications\SimpleNotification;
use App\User;

/**
 * Class SimpleNotificationsController.
 */
class SimpleNotificationsController extends Controller
{
    /**
     * Store.
     *
     * @param UserNotificationsIndex $request
     *
     * @return mixed
     */
    public function store(SimpleNotificationsStore $request)
    {
        User::findOrFail($request->user)->notify(new SimpleNotification($request->title));
//        $user = $user->fresh();
//        dd ($user->notifications);
//        return $user->fresh()->notifications->last();
    }
}
