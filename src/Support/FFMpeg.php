<?php

namespace Jimmy821231\LaravelFFMpeg\Support;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Jimmy821231\LaravelFFMpeg\Http\DynamicHLSPlaylist dynamicHLSPlaylist($disk)
 * @method static \Jimmy821231\LaravelFFMpeg\MediaOpener fromDisk($disk)
 * @method static \Jimmy821231\LaravelFFMpeg\MediaOpener fromFilesystem(\Illuminate\Contracts\Filesystem\Filesystem $filesystem)
 * @method static \Jimmy821231\LaravelFFMpeg\MediaOpener open($path)
 * @method static \Jimmy821231\LaravelFFMpeg\MediaOpener openUrl($path, array $headers)
 * @method static \Jimmy821231\LaravelFFMpeg\MediaOpener cleanupTemporaryFiles()
 *
 * @see \Jimmy821231\LaravelFFMpeg\MediaOpener
 */
class FFMpeg extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-ffmpeg';
    }
}
