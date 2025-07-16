<?php

namespace Arealtime\Messenger\App\Observers;

use Arealtime\Messenger\App\Models\Conversation;

class ConversationObserver
{
    public function creating(Conversation $conversation)
    {
        $conversation->user_id = auth()->id();
    }
}
