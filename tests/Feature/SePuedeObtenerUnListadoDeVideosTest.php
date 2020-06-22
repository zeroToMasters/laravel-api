<?php

namespace Tests\Feature;

use App\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SePuedeObtenerUnListadoDeVideosTest extends TestCase
{
    use RefreshDatabase;

    public function testSePuedeObtenerUnListadoDeVideos()
    {
        factory(Video::class, 2)->create();

        $this->getJson('/api/videos')
            ->assertOk()
            ->assertJsonCount(2);
    }

    public function testElPreviewDeUnVideoTieneIdYThumbnail()
    {
        $unId = 12345;
        $unThumbnail = 'http://unaimagen.com';

        factory(Video::class)->create([
            'id' => $unId,
            'thumbnail' => $unThumbnail,
        ]);

        $this->getJson('/api/videos')
            ->assertExactJson([
                [
                    'id' => $unId,
                    'thumbnail' => $unThumbnail,
                ],
            ]);
    }

    public function testLosVideosEstanOrdenadosDeMasNuevosAMasViejos()
    {
        $videoHaceUnMes = factory(Video::class)->create([
            'created_at' => Carbon::now()->subDays(30),
        ]);
        $videoHoy = factory(Video::class)->create([
            'created_at' => Carbon::now(),
        ]);
        $videoAyer = factory(Video::class)->create([
            'created_at' => Carbon::yesterday(),
        ]);

        $this->getJson('/api/videos')
            ->assertJsonPath('0.id', $videoHoy->id)
            ->assertJsonPath('1.id', $videoAyer->id)
            ->assertJsonPath('2.id', $videoHaceUnMes->id);
    }

    public function testSePuedeLimitarElNumeroDeVideosAObtener()
    {
        factory(Video::class, 4)->create();

        $this->getJson('/api/videos?limit=3')
            ->assertJsonCount(3);
    }

    public function testDevuelveUnprocessableCuandoElLimitEsUnString()
    {
        factory(Video::class, 4)->create();

        $this->getJson('/api/videos?limit=unstring')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
