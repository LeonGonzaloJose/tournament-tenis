<?php

namespace Tests\Feature;

use App\Models\PlayerModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayersApiTest extends TestCase
{
    /** @test */
    public function create_get_and_delete_player(): void
    {
        $playerData = [
            'name' => 'John Doe',
            'sex' => 'M',
            'age' => 25,
            'status' => 'A',
            'level' => 50
        ];

        $response = $this->post(route('v1.players.store'), $playerData);
        $contentJson = json_decode($response->getContent());
        $this->assertSame(201, $response->status());

        // Obtener el id generado
        $playerId = $contentJson->date->id;

        // Eliminar el jugador a través de la API
        $deleteResponse = $this->deleteJson("/api/v1/players/{$playerId}");
        $deleteResponse->assertStatus(204);

        // Intentar obtener el jugador eliminado para confirmar que no existe
        $getResponse = $this->getJson("/api/v1/players/{$playerId}");
        $getResponse->assertStatus(404);
    }
}
