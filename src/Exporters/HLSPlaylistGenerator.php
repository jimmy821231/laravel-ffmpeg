<?php

namespace Jimmy821231\LaravelFFMpeg\Exporters;

use Illuminate\Support\Collection;
use Jimmy821231\LaravelFFMpeg\Drivers\PHPFFMpeg;
use Jimmy821231\LaravelFFMpeg\Filesystem\Media;
use Jimmy821231\LaravelFFMpeg\Http\DynamicHLSPlaylist;
use Jimmy821231\LaravelFFMpeg\MediaOpener;
use Jimmy821231\LaravelFFMpeg\Support\StreamParser;

class HLSPlaylistGenerator implements PlaylistGenerator
{
    const PLAYLIST_START = '#EXTM3U';
    const PLAYLIST_END   = '#EXT-X-ENDLIST';

    /**
     * Return the line from the master playlist that references the given segment playlist.
     *
     * @param \Jimmy821231\LaravelFFMpeg\Filesystem\Media $playlistMedia
     * @param string $key
     * @return string
     */
    private function getStreamInfoLine(Media $segmentPlaylistMedia, string $key): string
    {
        $segmentPlaylist = $segmentPlaylistMedia->getDisk()->get(
            $segmentPlaylistMedia->getDirectory() . HLSExporter::generateTemporarySegmentPlaylistFilename($key)
        );

        $fileName = $segmentPlaylistMedia->getFilename();
        $lines = DynamicHLSPlaylist::parseLines($segmentPlaylist)->filter();

        return $lines->get($lines->search($fileName) - 1);
    }

    /**
     * Loops through all segment playlists and generates a main playlist. It finds
     * the relative paths to the segment playlists and adds the framerate when
     * to each playlist.
     *
     * @param array $segmentPlaylists
     * @param \Jimmy821231\LaravelFFMpeg\Drivers\PHPFFMpeg $driver
     * @return string
     */
    public function get(array $segmentPlaylists, PHPFFMpeg $driver): string
    {
        return Collection::make($segmentPlaylists)->map(function (Media $segmentPlaylist, $key) use ($driver) {
            $streamInfoLine = $this->getStreamInfoLine($segmentPlaylist, $key);

            $media = (new MediaOpener($segmentPlaylist->getDisk(), $driver))
                ->openWithInputOptions($segmentPlaylist->getPath(), ['-allowed_extensions', 'ALL']);

            if ($frameRate = StreamParser::new($media->getVideoStream())->getFrameRate()) {
                $streamInfoLine .= ",FRAME-RATE={$frameRate}";
            }

            return [$streamInfoLine, $segmentPlaylist->getFilename()];
        })->collapse()
            ->prepend(static::PLAYLIST_START)
            ->push(static::PLAYLIST_END)
            ->implode(PHP_EOL);
    }
}
