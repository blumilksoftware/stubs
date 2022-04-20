<?php

declare(strict_types=1);

namespace Blumilk\Stubs;

use Blumilk\Stubs\Console\Commands\PublishStubs;
use Illuminate\Support\ServiceProvider;

class BlumilkStubsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands(
                [
                    PublishStubs::class,
                ],
            );
        }
    }
}
