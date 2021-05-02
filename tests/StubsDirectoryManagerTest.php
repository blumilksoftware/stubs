<?php

declare(strict_types=1);

namespace Blumilk\Stubs\Testing;

use Blumilk\Stubs\Filesystem\StubsDirectoryManager;

class StubsDirectoryManagerTest extends FilesystemCase
{
    public function testCopying(): void
    {
        $manager = $this->getMockedManager();
        $manager->copy($this->getTestDirectory());

        $this->assertDirectoryExists($this->getTestDirectory());
        $this->assertFileExists($this->getTestDirectory() . "/cast.stub");
        $this->assertFileDoesNotExist($this->getTestDirectory() . "/random.stub");
    }

    public function testLinking(): void
    {
        $manager = $this->getMockedManager();
        $manager->link($this->getTestDirectory());

        $this->assertFileExists($this->getTestDirectory());
    }

    protected function getMockedManager(): StubsDirectoryManager
    {
        return new class($this->filesystem) extends StubsDirectoryManager {
            protected function getVendorPath(): string
            {
                return realpath(__DIR__ . "/../stubs");
            }
        };
    }
}
