<?php

namespace App\Http\Controllers;

use App\Http\Resources\SeriePreview;
use App\Serie;

class SeriesController extends Controller
{
    public function index()
    {
        return SeriePreview::collection(Serie::all());
    }
}
