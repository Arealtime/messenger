<?php

namespace Arealtime\Conversation\App\Enums;

enum ConversationJoinRequestStatusEnum: string
{
    case PENDING = 'PENDING';
    case ACCEPTED = 'ACCEPTED';
    case REJECTEDL = 'REJECTED';
}
