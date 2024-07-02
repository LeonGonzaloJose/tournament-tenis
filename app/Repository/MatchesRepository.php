<?php 

namespace App\Repository;

// use App\Helpers\HelperRepository;
use App\Models\MatchesModel;
use Exception;
use Illuminate\Support\Facades\DB;

class MatchesRepository{
    public function store(int $tournament_id ,int $player_one_id, int $player_two_id, int $winner) {
        return MatchesModel::create([
            'tournament_id'=> $tournament_id,
            'player_one_id'=> $player_one_id,
            'player_two_id'=> $player_two_id,
            'winner_id'=> $winner
        ]);
    }
}