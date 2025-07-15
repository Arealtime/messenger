<?php

namespace Arealtime\Conversation\App\Enums;

enum ConversationTypeEnum: string
{
    case CHAT = 'CHAT';
    case GROUP = 'GROUP';
    case CHANNEL = 'CHANNEL';
}
