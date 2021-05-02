<?php

declare(strict_types=1);

namespace Blumilk\Stubs\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class PublishStubs extends Command
{
    protected $name = "blumilk:stubs";
    protected $signature = "blumilk:stubs {--copy}";
    protected $description = "Provide a new codestyle to the Laravel stubs";

    public function handle(Filesystem $filesystem): void
    {
        $directory = $this->getStubsPath();

        if ($filesystem->exists($directory)) {
            $this->warn("There's already a stubs directory.");
            $agreement = $this->confirm("Please confirm you want to remove existing stubs:");

            if (!$agreement) {
                $this->info("Nothing has been done.");
                return;
            }

            if ($filesystem->isDirectory($directory)) {
                $filesystem->deleteDirectory($directory);
            } else {
                $filesystem->delete($directory);
            }

            $this->info("Existing ./stubs has been deleted.");
        }

        if ($this->option("copy")) {
            $filesystem->copyDirectory(
                directory: $this->getVendorPath(),
                destination: $directory,
            );

            $this->info("Stubs have been copied.");
            return;
        }

        $filesystem->link(
            target: $this->getVendorPath(),
            link: $directory,
        );

        $this->info("Stubs have been linked.");
    }

    protected function getStubsPath(): string
    {
        return base_path("stubs");
    }

    protected function getVendorPath(): string
    {
        return base_path("vendor/blumilksoftware/stubs/stubs");
    }
}
