<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TournamentApiTest extends TestCase
{
    /** @test */
    public function create_and_get(): void
    {
        $tournamentData = [
            'sex' => 'M',
            'name' => 'Test Tournament'
        ];

        $response = $this->post(route('v1.tournament.store'), $tournamentData);
        $contentJson = json_decode($response->getContent());
        $this->assertSame(201, $response->status());

        $getResponse = $this->get("/api/v1/tournament/{$contentJson->date->id}");
        $getResponse->assertStatus(200);
    }
}
