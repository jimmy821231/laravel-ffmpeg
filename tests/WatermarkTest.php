<?php

namespace Jimmy821231\LaravelFFMpeg\Tests;

use Illuminate\Support\Facades\Storage;
use Jimmy821231\LaravelFFMpeg\Filters\WatermarkFactory;
use Jimmy821231\LaravelFFMpeg\MediaOpener;

class WatermarkTest extends TestCase
{
    /** @test */
    public function it_can_export_a_single_video_file_with_a_watermark()
    {
        $this->fakeLocalVideoFile();
        $this->addTestFile('logo.png');

        (new MediaOpener)
            ->open('video.mp4')
            ->export()
            ->addWatermark(function (WatermarkFactory $watermarkFactory) {
                $watermarkFactory->open('logo.png');
            })
            ->inFormat($this->x264())
            ->save('video_with_logo.mp4');

        $this->assertTrue(Storage::disk('local')->has('video_with_logo.mp4'));
    }
}
