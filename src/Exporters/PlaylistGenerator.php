<?php

namespace Jimmy821231\LaravelFFMpeg\Exporters;

use Jimmy821231\LaravelFFMpeg\Drivers\PHPFFMpeg;

interface PlaylistGenerator
{
    public function get(array $playlistMedia, PHPFFMpeg $driver): string;
}
