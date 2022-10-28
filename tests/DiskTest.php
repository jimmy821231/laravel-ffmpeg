<?php

namespace Jimmy821231\LaravelFFMpeg\Tests;

use Jimmy821231\LaravelFFMpeg\Filesystem\Disk;

class DiskTest extends TestCase
{
    /** @test */
    public function it_can_normalize_paths()
    {
        $this->assertEquals('test.mp4', Disk::normalizePath('test.mp4'));
        $this->assertEquals('/test.mp4', Disk::normalizePath('/test.mp4'));
        $this->assertEquals('D:/test.mp4', Disk::normalizePath('D:\test.mp4'));
    }
}
