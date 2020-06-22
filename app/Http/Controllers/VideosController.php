<?php

namespace App\Http\Controllers;

use App\Dtos\VideoPreview;
use App\Http\Requests\ListadoDeVideosRequest;
use App\Video;

class VideosController extends Controller
{
    public function get(Video $video)
    {
        return $video;
    }

    public function index(ListadoDeVideosRequest $request)
    {
        return Video::limit($request->getLimit())
            ->orderBy('created_at', 'DESC')
            ->get()
            ->mapInto(VideoPreview::class);
    }
}
