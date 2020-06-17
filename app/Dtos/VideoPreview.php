<?php

namespace App\Dtos;

use App\Video;
use JsonSerializable;

class VideoPreview implements JsonSerializable
{
    private Video $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    public function jsonSerialize(): array
    {
        return [
           'id' => $this->video->id,
           'thumbnail' => $this->video->thumbnail,
       ];
    }
}
