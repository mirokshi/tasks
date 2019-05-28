<?php

namespace App\Http\Controllers\Api\PushSubscriptions;

use App\Http\Requests\PushSubscriptions\PushSubscriptionDestroy;
use App\Http\Requests\PushSubscriptions\PushSubscriptionUpdate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PushSubscriptionController extends Controller
{
    /**
     * Update user's subscription.
     *
     * @param Request $request
     * @return void
     */
    public function update(PushSubscriptionUpdate $request)
    {
        $request->user()->updatePushSubscription(
            $request->endpoint,
            $request->key,
            $request->token
        );
    }
    /**
     * Delete the specified subscription.
     *
     * @param PushSubscriptionDestroy $request
     * @return Response
     */
    public function destroy(PushSubscriptionDestroy $request)
    {
        $request->user()->deletePushSubscription($request->endpoint);
        return response()->json(null, 204);
    }
}
