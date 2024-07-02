<?php 

namespace App\Repository;

use App\Dto\Tournament\{TournamentIndexRequestDto, TournamentShowRequestDto, TournamentStoreRequestDto};
use App\Models\TournamentModel;
use Exception;

class TournamentRepository{

    /**
     * Summary: Busca un listado de registros segun los parametros dados
     * 
     * @param TournamentIndexRequestDto $request
     * @return object;
     */
    public function index(TournamentIndexRequestDto $request): object
    {
        $query = TournamentModel::query();

        if ($request->getName()) {
            $query->where('tournaments.name', "LIKE","%{$request->getName()}%");
        }
    
        if ($request->getSex()) {
            $query->where('tournaments.sex', $request->getSex());
        }
    
        if ($request->getWinner_id()) {
            $query->whereDate('winner', $request->getWinner_id());
        }

        return $query->join('players', 'players.id', '=', 'tournaments.winner')->select([
                'tournaments.*',
                'players.name AS players_name',
                'players.age',
                'players.level'
            ])->get();
    }

    /**
     * Summary: Busca un unico registro segun su id
     * @param TournamentShowRequestDto $request
     * @return object
     */
    public function show(TournamentShowRequestDto $request): object
    {
        $player = TournamentModel::findOrFail($request->getId());
        
        return $player;
    }

    /**
     * Summary: Crea un torneo indicando el nombre, el sexo de los participantes y la cantidad de participantes
     * @param TournamentStoreRequestDto $request
     * @param int $total_participants
     * @return object
     */
    public function store(TournamentStoreRequestDto $request, int $total_participants): object
    {
        return TournamentModel::create([
            "name"=> $request->getName(),
            "participants"=> $total_participants,
            "sex"=> $request->getSex()
        ]);
    }

    /**
     * Summary: Actualiza un torneo para agregarle el ganador
     * @param int $id Identificador del torneo
     * @param int $winner Identificador del ganador
     * @return object
     */
    public function update(int $id, int $winner): object
    {
        try {
            $tournament = TournamentModel::findOrFail($id);

            $tournament->winner = $winner;

            if (!$tournament->save()){
                throw new Exception('Error al actualizar el jugador', 500);
            }

            $tournament = TournamentModel::query();
            
            return $tournament->join('players', 'players.id', '=', 'tournaments.winner')
                    ->where("tournaments.id",$id)
                    ->select([
                        'tournaments.*',
                        'players.name AS players_name',
                        'players.age',
                        'players.level'
                    ])->get();
        } catch (Exception $e) {
            throw new Exception('Error al actualizar el jugador: No existe el jugardor', 404);
        }  
    }
}