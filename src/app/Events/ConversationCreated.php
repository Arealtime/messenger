<?php

namespace Arealtime\Messenger\App\Events;

use Arealtime\Messenger\App\Models\Conversation;
use Illuminate\Foundation\Events\Dispatchable;

class ConversationCreated
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(public readonly Conversation $conversation, public readonly array $userIds)
    {
        //
    }
}
