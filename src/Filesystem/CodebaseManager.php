<?php

declare(strict_types=1);

namespace Blumilk\Stubs\Filesystem;

use Illuminate\Filesystem\Filesystem;

class CodebaseManager
{
    protected Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function check(string $directory): bool
    {
        return $this->filesystem->exists($directory);
    }

    public function clean(string $directory): void
    {
        if ($this->filesystem->isDirectory($directory)) {
            $this->filesystem->deleteDirectory($directory);
        } else {
            $this->filesystem->delete($directory);
        }
    }
}
