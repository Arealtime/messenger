<?php

namespace Arealtime\Messenger\App\Enums;

enum MessengerCommandEnum: string
{
    case Help = 'help';
    case Migrate = 'migrate';
    case Config = 'config';
}
