<?php 

namespace App\Repository;

use App\Dto\Player\{PlayerStatesStoreRequestDto};
use App\Models\{PlayerStatsModel};
use Exception;

class PlayersStatsRepository{

    /**
     * Summary: Crea las estadisticas de un jugador estadisticas
     * @param PlayerStatesStoreRequestDto $request_stats
     * @return object
     */
    public static function store(int $player_id, PlayerStatesStoreRequestDto $request_stats): object
    {
        try {
            return PlayerStatsModel::create([
                'player_id' => $player_id,
                'speed' => $request_stats->getSpeed(),
                'strength' => $request_stats->getStrength(),
                'reflex' => $request_stats->getReflex(),
                'energy' => $request_stats->getEnergy()
            ]);

        } catch (Exception $e) {
            throw new Exception('Error al crear el jugador y sus estadísticas: ' . $e->getMessage(), 500);
        }
    }
}