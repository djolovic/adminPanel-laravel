<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewFeed;
use App\Models\NewsFeed;
use App\Models\SupportChatConversation;
use Illuminate\Http\Request;
use Illuminate\Redis\RedisManager;

class SupportChatController extends Controller
{
    public function index(SupportChatConversation $supportChatConversation)
    {
        $conversations = $supportChatConversation->where('in_progress', 0)->where(
            'resolved',
            '!=',
            1
        )->with(
            'chatMessageLast'
        )->get()
        ;
        $chatMassages = $conversations->first();

        return view(
            'chat.index',
            [
                'conversations' => $conversations,
                'firstChatMessages' => is_null($chatMassages)
                    ? []
                    : $chatMassages->chatMessages()
                        ->get(),
            ]
        );
    }

    public function fetchMessagesForConversationId(
        Request $request,
        SupportChatConversation $supportChatConversation
    ) {

        if (!$request->has('conversationId')) {
            return response()->json([], 401);
        }

        $chatConversations = $supportChatConversation->with('chatMessages')->where(
            'conversation_id',
            $request->get('conversationId')
        )->first()
        ;

        if (is_null($chatConversations))  return response()->json(['messages'=>[]], 200);

        return response()->json(['messages' => $chatConversations->chatMessages]);
    }

    public function test(RedisManager $redisManager)
    {
        SendNewFeed::dispatch(NewsFeed::first(), $redisManager);
    }
}
