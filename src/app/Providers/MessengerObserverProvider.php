<?php

namespace Arealtime\Messenger\App\Providers;

use Arealtime\Messenger\App\Models\Conversation;
use Arealtime\Messenger\App\Observers\ConversationObserver;
use Illuminate\Support\ServiceProvider;

class MessengerObserverProvider extends ServiceProvider
{
    public function boot()
    {
        Conversation::observe(ConversationObserver::class);
    }
}
