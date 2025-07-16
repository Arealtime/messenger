<?php

namespace Arealtime\Messenger\App\Providers;

use Arealtime\Messenger\App\Console\Commands\MessengerCommand;
use Illuminate\Support\ServiceProvider;

class MessengerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([MessengerCommand::class]);

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/arealtime-messenger.php',
            'arealtime-messenger'
        );

        $this->app->register(MessengerObserverProvider::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'messenger');
    }
}
