<?php

declare(strict_types=1);

namespace Blumilk\Stubs\Console\Commands;

use Illuminate\Console\Command;

class PublishStubs extends Command
{
    protected $name = "blumilk:stubs {--copy}";
    protected $description = "Provide a new codestyle to the Laravel stubs";

    public function handle(): void
    {
    }
}
