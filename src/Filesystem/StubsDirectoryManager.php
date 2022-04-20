<?php

declare(strict_types=1);

namespace Blumilk\Stubs\Filesystem;

use Illuminate\Filesystem\Filesystem;

class StubsDirectoryManager
{
    public function __construct(
        protected Filesystem $filesystem,
    ) {}

    public function link(string $directory): void
    {
        $this->filesystem->link(
            target: $this->getVendorPath(),
            link: $directory,
        );
    }

    public function copy(string $directory): void
    {
        $this->filesystem->copyDirectory(
            directory: $this->getVendorPath(),
            destination: $directory,
        );
    }

    protected function getVendorPath(): string
    {
        return base_path("vendor/blumilksoftware/stubs/stubs");
    }
}
