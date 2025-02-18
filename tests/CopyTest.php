<?php

namespace Jimmy821231\LaravelFFMpeg\Tests;

use Illuminate\Support\Facades\Storage;
use Jimmy821231\LaravelFFMpeg\FFMpeg\CopyFormat;
use Jimmy821231\LaravelFFMpeg\MediaOpener;

class CopyTest extends TestCase
{
    /** @test */
    public function it_can_export_a_single_video_file_in_the_same_codec_in_a_different_container()
    {
        $this->fakeLocalVideoFile();

        (new MediaOpener)
            ->open('video.mp4')
            ->export()
            ->inFormat(new CopyFormat)
            ->save('new_video.mkv');

        $this->assertTrue(Storage::disk('local')->has('new_video.mkv'));
    }
}
