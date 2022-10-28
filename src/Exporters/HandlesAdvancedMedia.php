<?php

namespace Jimmy821231\LaravelFFMpeg\Exporters;

use FFMpeg\Format\FormatInterface;
use Jimmy821231\LaravelFFMpeg\FFMpeg\AdvancedOutputMapping;
use Jimmy821231\LaravelFFMpeg\Filesystem\Media;

trait HandlesAdvancedMedia
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $maps;

    public function addFormatOutputMapping(FormatInterface $format, Media $output, array $outs, $forceDisableAudio = false, $forceDisableVideo = false)
    {
        $this->maps->push(
            new AdvancedOutputMapping($outs, $format, $output, $forceDisableAudio, $forceDisableVideo)
        );

        return $this;
    }
}
