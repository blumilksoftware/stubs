<?php

declare(strict_types=1);

namespace Blumilk\Stubs\Console\Commands;

use Blumilk\Stubs\Filesystem\CodebaseManager;
use Blumilk\Stubs\Filesystem\StubsDirectoryManager;
use Illuminate\Console\Command;

class PublishStubs extends Command
{
    protected $name = "blumilk:stubs";
    protected $signature = "blumilk:stubs {--copy}";
    protected $description = "Provide a new codestyle to the Laravel stubs";

    public function handle(CodebaseManager $codebaseManager, StubsDirectoryManager $stubsDirectoryManager): void
    {
        $directory = $this->getStubsPath();

        if ($codebaseManager->check($directory)) {
            $this->warn("There's already a stubs directory.");
            if (!$this->confirm("Please confirm you want to remove existing stubs:")) {
                $this->info("Nothing has been done.");
                return;
            }

            $codebaseManager->clean($directory);
            $this->info("Existing ./stubs has been deleted.");
        }

        if ($this->option("copy")) {
            $stubsDirectoryManager->copy($directory);
            $this->info("Stubs have been copied.");
            return;
        }

        $stubsDirectoryManager->link($directory);
        $this->info("Stubs have been linked.");
    }

    protected function getStubsPath(): string
    {
        return base_path("stubs");
    }
}
