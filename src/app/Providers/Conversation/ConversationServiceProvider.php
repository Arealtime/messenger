<?php

namespace Arealtime\Messenger\App\Providers\Conversation;

use Illuminate\Support\ServiceProvider;

class ConversationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(ConversationRouteServiceProvider::class);
        $this->app->register(ConversationEventServiceProvider::class);
    }

    public function boot() {}
}
