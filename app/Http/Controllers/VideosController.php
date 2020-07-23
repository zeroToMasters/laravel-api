<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListadoDeVideosRequest;
use App\Http\Resources\VideoPreview;
use App\Video;

class VideosController extends Controller
{
    public function get(Video $video)
    {
        return $video;
    }

    public function index(ListadoDeVideosRequest $request)
    {
        $videos = Video::ultimos($request->getLimit(), $request->getPage())->get();

        return VideoPreview::collection($videos);
    }
}
