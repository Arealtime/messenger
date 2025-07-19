<?php

namespace Arealtime\Messenger\App\Providers\Conversation;

use Arealtime\Messenger\App\Events\ConversationCreated;
use Arealtime\Messenger\App\Listeners\AddUserToConversation;
use Illuminate\Support\ServiceProvider;

class ConversationEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ConversationCreated::class => [
            AddUserToConversation::class
        ]
    ];
}
