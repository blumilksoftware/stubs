<?php

declare(strict_types=1);

namespace Blumilk\Stubs\Testing;

use Blumilk\Stubs\Filesystem\CodebaseManager;

class CodebaseManagerTest extends FilesystemCase
{
    public function testCodebaseWithoutTargetDirectory(): void
    {
        $manager = new CodebaseManager($this->filesystem);
        $exists = $manager->check($this->getTestDirectory());

        $this->assertFalse($exists);
    }

    public function testCodebaseWithTargetDirectory(): void
    {
        $this->filesystem->makeDirectory($this->getTestDirectory());

        $manager = new CodebaseManager($this->filesystem);
        $exists = $manager->check($this->getTestDirectory());

        $this->assertTrue($exists);
    }

    public function testDeletingTargetDirectory(): void
    {
        $this->filesystem->makeDirectory($this->getTestDirectory());
        $this->assertDirectoryExists($this->getTestDirectory());

        $manager = new CodebaseManager($this->filesystem);
        $manager->clean($this->getTestDirectory());

        $this->assertDirectoryDoesNotExist($this->getTestDirectory());
    }

    public function testDeletingTargetFile(): void
    {
        $this->filesystem->put($this->getTestDirectory(), "");
        $this->assertFileExists($this->getTestDirectory());

        $manager = new CodebaseManager($this->filesystem);
        $manager->clean($this->getTestDirectory());

        $this->assertFileDoesNotExist($this->getTestDirectory());
    }
}
