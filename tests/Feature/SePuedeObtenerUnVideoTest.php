<?php

namespace Tests\Feature;

use App\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SePuedeObtenerUnVideoTest extends TestCase
{
    use RefreshDatabase;

    public function testSePuedeObtenerUnVideoPorSuId()
    {
        $video = factory(Video::class)->create();

        $this->get(
            sprintf(
                '/api/videos/%s',
                $video->id
        ))->assertExactJson([
            'id' => $video->id,
            'titulo' => $video->titulo,
            'descripcion' => $video->descripcion,
            'url_video' => $video->url_video,
        ]);
    }
}
