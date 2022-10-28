<?php

namespace Jimmy821231\LaravelFFMpeg\Tests;

use Jimmy821231\LaravelFFMpeg\Support\FFMpeg;

class DefaultConfigTest extends TestCase
{
    /** @test */
    public function it_has_a_default_of_1_threads()
    {
        $this->fakeLocalVideoFile();

        $command = FFMpeg::open('video.mp4')
            ->export()
            ->getCommand('test.mp4');

        $this->assertStringContainsString('-threads 1', $command[0]);
    }
}
