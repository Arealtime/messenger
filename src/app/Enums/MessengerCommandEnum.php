<?php

namespace Arealtime\Conversation\App\Enums;

enum MessengerCommandEnum: string
{
    case Help = 'help';
    case Migrate = 'migrate';
    case Config = 'config';
}
