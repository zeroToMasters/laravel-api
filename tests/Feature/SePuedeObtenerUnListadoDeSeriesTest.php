<?php

namespace Tests\Feature;

use App\Serie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SePuedeObtenerUnListadoDeSeriesTest extends TestCase
{
    use RefreshDatabase;

    public function testSePuedeObtenerUnListadoDeSeries()
    {
        factory(Serie::class, 2)->create();

        $this->getJson('/api/series')
            ->assertOk()
            ->assertJsonCount(2);
    }

    public function testElPreviewDeUnaSerieTieneElFormatoCorrect()
    {
        $id = 12345;
        $titulo = 'Un titulo';
        $thumbnail = 'http://unaimagen.com/imagen.jpg';
        $resumen = 'Un resumen';

        factory(Serie::class)->create([
            'id' => $id,
            'titulo' => $titulo,
            'thumbnail' => $thumbnail,
            'resumen' => $resumen,
        ]);

        $this->getJson('/api/series')
            ->assertExactJson([
                [
                    'id' => $id,
                    'titulo' => $titulo,
                    'thumbnail' => $thumbnail,
                    'resumen' => $resumen,
                ],
            ]);
    }
}
