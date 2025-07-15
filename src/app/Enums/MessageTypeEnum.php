<?php

namespace Arealtime\Conversation\App\Enums;

enum MessageTypeEnum: string
{
    case TEXT = 'TEXT';
    case VOICE = 'VOICE';
    case IMAGE = 'IMAGE';
    case VIDEO = 'VIDEO';
}
