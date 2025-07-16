<?php

namespace Arealtime\Messenger\App\Traits\Conversation;

use Arealtime\Messenger\App\Models\ConversationUser;
use Arealtime\Messenger\App\Models\Message;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ConversationRelation
{
    public function lastMessage(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'last_message_id');
    }

    public function pinnedMessage(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'pinned_message_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('arealtime-messenger.user_model'));
    }

    public function conversationUser(): HasMany
    {
        return $this->hasMany(ConversationUser::class);
    }
}