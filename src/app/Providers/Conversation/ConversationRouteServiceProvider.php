<?php

namespace Arealtime\Messenger\App\Providers\Conversation;

use Arealtime\Messenger\App\Models\Conversation;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ConversationRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Route::bind('ownedConversation', function ($id) {
            return Conversation::where('id', $id)->currentUser()->firstOrFail();
        });

        Route::bind('conversation', function ($id) {
            return Conversation::where('id', $id)->firstOrFail();
        });

        Route::pattern('ownedConversation', '[0-9]+');
    }
}
