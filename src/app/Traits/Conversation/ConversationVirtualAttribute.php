<?php

namespace Arealtime\Messenger\App\Traits\Conversation;

use Arealtime\Messenger\App\Enums\ConversationTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait ConversationVirtualAttribute
{
    protected function isChat(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->type == ConversationTypeEnum::CHAT
        );
    }

    protected function isChannel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->type == ConversationTypeEnum::CHANNEL
        );
    }

    protected function isGroup(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->type == ConversationTypeEnum::GROUP
        );
    }
}
