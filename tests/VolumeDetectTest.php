<?php

namespace Jimmy821231\LaravelFFMpeg\Tests;

use Jimmy821231\LaravelFFMpeg\Support\FFMpeg;

class VolumeDetectTest extends TestCase
{
    /** @test */
    public function it_can_fetch_the_results_from_volume_detection()
    {
        $this->fakeLocalVideoFile();

        $processOutput = FFMpeg::open('video.mp4')
            ->export()
            ->addFilter(['-filter:a', 'volumedetect', '-f', 'null'])
            ->getProcessOutput();

        $this->assertIsArray($processOutput->all());
        $this->assertIsArray($processOutput->errors());
        $this->assertIsArray($processOutput->out());

        $this->assertStringContainsString('Parsed_volumedetect_0', implode('', $processOutput->all()));
    }
}
