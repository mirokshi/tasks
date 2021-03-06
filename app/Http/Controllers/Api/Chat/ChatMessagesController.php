<?php

namespace App\Http\Controllers\Api\Chat;




use App\Channel;
use App\ChatMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\ChatMessagesDestroy;
use App\Http\Requests\Chat\ChatMessagesIndex;
use App\Http\Requests\Chat\ChatMessagesStore;

/**
 * Class ChangelogController
 *
 * @package App\Http\Controllers\Tenant\Api\Changelog
 */
class ChatMessagesController extends Controller
{
    /**
     * Index
     *
     * @param ChatMessagesIndex $request
     * @return mixed
     */
    public function index(ChatMessagesIndex $request,Channel $channel)
    {
        return map_collection($channel->messages);
    }

    /**
     * Store
     *
     * @param ChatMessagesStore $request
     * @return mixed
     */
    public function store(ChatMessagesStore $request, Channel $channel)
    {
        $channel->addMessage($message = ChatMessage::create([
            'text' => $request->text
        ]));
        return $message;
    }

    /**
     * Destroy
     *
     * @param ChatMessagesDestroy $request
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ChatMessagesDestroy $request, Channel $channel, ChatMessage $message)
    {
        $message->delete();
        return $message;
    }
}
