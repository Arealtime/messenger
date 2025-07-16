<?php

namespace Arealtime\Conversation\App\Traits\Conversation;

use Arealtime\Messenger\App\Enums\ConversationTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait ConversationVirtualAttribute
{
    protected function isChat(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $value == ConversationTypeEnum::CHAT,
        );
    }

    protected function isChannel(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $value == ConversationTypeEnum::CHANNEL,
        );
    }

    protected function isGroup(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $value == ConversationTypeEnum::GROUP,
        );
    }
}
