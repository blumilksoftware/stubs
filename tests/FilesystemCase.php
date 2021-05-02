<?php

declare(strict_types=1);

namespace Blumilk\Stubs\Testing;

use Illuminate\Filesystem\Filesystem;
use PHPUnit\Framework\TestCase;

abstract class FilesystemCase extends TestCase
{
    protected Filesystem $filesystem;

    protected function setUp(): void
    {
        $this->filesystem = new Filesystem();
        $this->cleanCodebase();
    }

    protected function tearDown(): void
    {
        $this->cleanCodebase();
    }

    protected function cleanCodebase(): void
    {
        $this->filesystem->delete($this->getTestDirectory());
        $this->filesystem->deleteDirectory($this->getTestDirectory());
    }

    protected function getTestName(): string
    {
        return "test";
    }

    protected function getTestDirectory(): string
    {
        return __DIR__ . "/" . $this->getTestName();
    }
}
