<?php 

namespace App\Repository;

use App\Dto\Player\{PlayerDeleteRequestDto, PlayerIndexRequestDto, PlayerShowRequestDto, PlayerStatesStoreRequestDto, PlayerStoreRequestDto, PlayerUpdatePartialRequestDto, PlayerUpdateRequestDto};
use App\Models\{PlayerModel, PlayerStatsModel};
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class PlayersRepository{

    /**
     * Summary: Obtiene una lista de jugadores segun los parametros brindados
     * @param PlayerStoreRequestDto $request
     * @return object
     */
    public function index(PlayerIndexRequestDto $request): object
    {
        $query = PlayerModel::query();

        if ($request->getName()){
            $query->where('name','LIKE',"%{$request->getName()}%");
        }

        if ($request->getSex()){
            $query->where('sex', $request->getSex());
        }
        
        if ($request->getStatus()){
            $query->where('status', $request->getStatus());
        }

        if ($request->getLevel()){
            $query->where('level', $request->getLevel());
        }

        return $query->select('players.*', 'player_stats.speed', 'player_stats.strength', 'player_stats.reflex', 'player_stats.energy')
                ->join('player_stats', 'players.id', '=', 'player_stats.player_id')
                ->get();
    }

    /**
     * Summary: Obtiene un listado de participantes segun su sexo
     * @param string $sex
     * @return object
     */
    public function getParticipants(string $sex): object
    {
        $query = PlayerModel::query();
        $query->select('players.*', 'player_stats.speed', 'player_stats.strength', 'player_stats.reflex', 'player_stats.energy')
            ->join('player_stats', 'players.id', '=', 'player_stats.player_id')
            ->where('players.sex', $sex)
            ->where('players.status', 'A')
            ->where('player_stats.deleted_at', null);

        return $query->get();
    }

    /**
     * Summary: Obtiene a un jugador segun su ID
     * @param PlayerShowRequestDto $request
     * @return object
     */
    public function show(PlayerShowRequestDto $request): object
    {
        try {
            $player = PlayerModel::join('player_stats', 'players.id', '=', 'player_stats.player_id')
                    ->select(["players.*", "player_stats.speed", "player_stats.strength", "player_stats.reflex", "player_stats.energy"])
                    ->findOrFail($request->getId());
            return $player;
        } catch (Exception $e) {
            throw new Exception('Error al actualizar el jugador: No existe el jugardor', 404);
        }   
    }

    /**
     * Summary: Crea un jugador y sus estadisticas
     * @param PlayerStoreRequestDto $request
     * @return object
     */
    public function store(PlayerStoreRequestDto $request): object
    {
        try {
            
            $player = PlayerModel::create([
                'name' => $request->getName(),
                'age' => $request->getAge(),
                'sex' => $request->getSex(),
                'level' => $request->getLevel()
            ]);

            return $player;
        } catch (Exception $e) {
            throw new Exception('Error al crear el jugador y sus estadísticas: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Summary: Actualiza todos los datos de un registro segun su id
     * @param PlayerUpdateRequestDto $request
     * @return object
     */
    public function update(PlayerUpdateRequestDto $request): object
    {
        try {
            $player = PlayerModel::findOrFail($request->getId());

            $player->name = $request->getName();
            $player->age = $request->getAge();
            $player->sex = $request->getSex();
            $player->level = $request->getLevel();
            $player->status = $request->getStatus();

            if (!$player->save()){
                throw new Exception('Error al actualizar el jugador', 500);
            }
            
            return $player;
        } catch (Exception $e) {
            throw new Exception('Error al actualizar el jugador: No existe el jugardor', 404);
        }   
    }

    /**
     * Summary: Actualiza los datos indicados de un registro segun su id
     * @param PlayerUpdatePartialRequestDto $request
     * @return object
     */
    public function updatePartial(PlayerUpdatePartialRequestDto $request): object
    {
        try {
            $player = PlayerModel::findOrFail($request->getId());

            if ($request->getName()){
                $player->name = $request->getName();
            }
            if ($request->getAge()){
                $player->age = $request->getAge();
            }
            if ($request->getSex()){
                $player->sex = $request->getSex();
            }
            if ($request->getLevel()){
                $player->level = $request->getLevel();
            }
            if ($request->getStatus()){
                $player->status = $request->getStatus();
            }

            if (!$player->save()){
                throw new Exception('Error al actualizar el jugador', 500);
            }
            
            return $player;
        } catch (Exception $e) {
            throw new Exception('Error al actualizar el jugador: No existe el jugardor', 404);
        }   
    }

    /**
     * Summary: Permite eliminar un registro segun su id
     * @param PlayerDeleteRequestDto $request
     * @return
     */
    public function destroy(PlayerDeleteRequestDto $request)
    {
        try {
            $player = PlayerModel::findOrFail($request->getId());
            $stats = PlayerStatsModel::where('player_id', $request->getId())->firstOrFail();

            if (!$player->delete() || !$stats->delete()){
                throw new Exception('Error al actualizar el jugador', 500);
            }
        
            return response()->noContent();
        } catch (ModelNotFoundException $e) {
            throw new Exception('El jugador y sus estadísticas no existen', 404);
        } catch (Exception $e) {
            throw new Exception('Error al eliminar el jugador: ' . $e->getMessage(), $e->getCode() ?? 500);
        }
    }
}