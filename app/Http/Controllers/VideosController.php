<?php

namespace App\Http\Controllers;

use App\Video;

class VideosController extends Controller
{
    public function get(Video $video)
    {
        return $video;
    }

    public function index()
    {
        return Video::orderBy('created_at', 'DESC')->get();
    }
}
