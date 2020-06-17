<?php

namespace App\Http\Controllers;

use App\Dtos\VideoPreview;
use App\Video;

class VideosController extends Controller
{
    public function get(Video $video)
    {
        return $video;
    }

    public function index()
    {
        $videos = Video::orderBy('created_at', 'DESC')->get()
            ->mapInto(VideoPreview::class);

        return $videos;
    }
}
