<?php

namespace Arealtime\Messenger\App\Listeners;

use Arealtime\Messenger\App\Events\ConversationCreated;
use Illuminate\Support\Facades\DB;

class AddUserToConversation
{

    public function handle(ConversationCreated $event): void
    {
        $userIds = array_map(fn(int $id) => ['user_id' => $id], $event->userIds);
        $conversation = $event->conversation;

        DB::transaction(function () use ($conversation, $userIds) {
            $conversation->conversationUsers()->delete();

            $conversation->conversationUsers()->createMany($userIds);
        });
    }
}
