<?php

namespace Tests\Feature;

use App\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function testElPayloadContieneLosVideosEnElSistema()
    {
        $videos = factory(Video::class, 2)->create();

        $this->getJson('/api/videos')
            ->assertJson($videos->toArray());
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
}
