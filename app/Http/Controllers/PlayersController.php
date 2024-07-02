<?php

namespace App\Http\Controllers;

use App\Dto\Player\{PlayerDeleteRequestDto, PlayerIndexRequestDto, PlayerShowRequestDto, PlayerStoreRequestDto, PlayerUpdatePartialRequestDto, PlayerUpdateRequestDto};
use App\Http\Requests\Player\{PlayerDestroyRequest, PlayerIndexRequest, PlayerShowRequest, PlayerStoreRequest, PlayerUpdatePartialRequest, PlayerUpdateRequest};
use App\Services\PlayersService;
use Exception;

class PlayersController extends Controller
{
    private PlayersService $playersService;

    public function __construct(PlayersService $servise)
    {
        $this->playersService = $servise;
    }
    
    /**
     * @OA\Get(
     *      path="/api/v1/players",
     *      tags={"players"},
     *      operationId="player_index",
     *      summary="Obtiene un listado de jugadores",
     *      security={
     *          {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          description="Nombre del jugador",
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="sex",
     *          in="query",
     *          description="Sexo del jugador",
     *          @OA\Schema(
     *              type="string",
     *              enum={"M", "F"},
     *              description="M = Masculino, F = Femenino"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="age",
     *          in="query",
     *          description="Edad del jugador",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *          name="status",
     *          in="query",
     *          description="Estado del jugador",
     *          @OA\Schema(
     *              type="string",
     *              enum={"A", "I"},
     *              description="A = Activo, I = Inactivo"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="level",
     *          in="query",
     *          description="Nivel del jugador",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200, description="Success")
     * )
     */
    public function index(PlayerIndexRequest $request)
    {
        try {
            $response = $this->playersService->index(new PlayerIndexRequestDto($request->all()));

            return response(["status"=> "succes", "message"=> "Lista de jugadores obtenida correctamente", "date"=> $response]);
        } catch (Exception $e) {
            return response($e->getMessage(), $e->getCode() ?? 422);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/v1/players/{id}",
     *      tags={"players"},
     *      operationId="player_show",
     *      summary="Obtiene un jugador",
     *      security={
     *          {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Identificador del jugador",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200, description="Success"),
     *      @OA\Response(response=404, description="Player not found")
     * )
     */
    public function show(PlayerShowRequest $request)
    {
        try {
            $response = $this->playersService->show(new PlayerShowRequestDto($request->all()));

            return response(["status"=> "succes", "message"=> "Jugador obtenido correctamente", "date"=> $response]);
        } catch (Exception $e) {
            return response($e->getMessage(), $e->getCode() ?? 422);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/v1/players",
     *      tags={"players"},
     *      operationId="player_store",
     *      summary="Crea un nuevo jugador",
     *      security={
     *          {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          description="Nombre del jugador",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="age",
     *          in="query",
     *          description="Edad del jugador",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *          name="sex",
     *          in="query",
     *          description="Sexualidad del jugador",
     *          @OA\Schema(
     *              type="string",
     *              enum={"M", "F"},
     *              description="M = Masculino, F = Femenino"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="level",
     *          in="query",
     *          description="Nivel del jugador",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200,description="Success")
     * )
     */
    public function store(PlayerStoreRequest $request)
    {
        try {
            $response = $this->playersService->store(new PlayerStoreRequestDto($request->all()));

            return response()->json(["status"=> "succes", "message"=> "Jugador creado correctamente", "date"=> $response], 201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getCode() ?? 422);
        }
    }

    /**
     * @OA\put(
     *      path="/api/v1/players/{id}",
     *      tags={"players"},
     *      operationId="player_update",
     *      summary="Actualiza los datos de un jugador segun si ID",
     *      security={
     *          {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Identificador del jugador",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          description="Nombre del jugador",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="sex",
     *          in="query",
     *          description="Sexualidad del jugador",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              enum={"M", "F"},
     *              description="M = Masculino, F = Femenino"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="age",
     *          in="query",
     *          description="Edad del jugador",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *          name="status",
     *          in="query",
     *          description="Estado del jugador",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              enum={"A", "I"},
     *              description="A = Activo, I = Inactivo"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="level",
     *          in="query",
     *          description="Nivel del jugador",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200,description="Success"),
     *      @OA\Response(response=404, description="Player not found")
     * )
     */
    public function update(PlayerUpdateRequest $request)
    {
        try {
            $response = $this->playersService->update(new PlayerUpdateRequestDto($request->all()));

            return response()->json(["status"=> "succes", "message"=> "Jugador actualizado correctamente", "date"=> $response], 200);
        } catch (Exception $e) {
            return response()->json(["status"=> "error", "message"=> $e->getMessage()], $e->getCode() ?? 422);
        }
    }

    /**
     * @OA\patch(
     *      path="/api/v1/players/update/{id}",
     *      tags={"players"},
     *      operationId="player_update_partial",
     *      summary="Actualiza los datos de un jugador segun si ID",
     *      security={
     *          {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Identificador del jugador",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          description="Nombre del jugador",
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="sex",
     *          in="query",
     *          description="Sexualidad del jugador",
     *          @OA\Schema(
     *              type="string",
     *              enum={"M", "F"},
     *              description="M = Masculino, F = Femenino"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="age",
     *          in="query",
     *          description="Edad del jugador",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *          name="status",
     *          in="query",
     *          description="Estado del jugador",
     *          @OA\Schema(
     *              type="string",
     *              enum={"A", "I"},
     *              description="A = Activo, I = Inactivo"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="level",
     *          in="query",
     *          description="Nivel del jugador",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200,description="Success"),
     *      @OA\Response(response=404, description="Player not found")
     * )
     */
    public function updatePartial(PlayerUpdatePartialRequest $request)
    {
        try {
            $response = $this->playersService->updatePartial(new PlayerUpdatePartialRequestDto($request->all()));

            return response()->json(["status"=> "succes", "message"=> "Jugador actualizado correctamente", "date"=> $response], 200);
        } catch (Exception $e) {
            return response()->json(["status"=> "error", "message"=> $e->getMessage()], $e->getCode() ?? 422);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/players/{id}",
     *      tags={"players"},
     *      operationId="player_delete",
     *      summary="Elimina a un jugador",
     *      security={
     *          {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Identificador del jugador",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200,description="Success")
     * )
     */
    public function destroy(PlayerDestroyRequest $request)
    {
        try {
            $response = $this->playersService->destroy(new PlayerDeleteRequestDto($request->all()));

            return response()->json(["status"=> "succes", "message"=> "Jugador eliminado correctamente", "date"=> ["delete"=>true]], 204);
        } catch (Exception $e) {
            return response()->json(["status"=> "error", "message"=> $e->getMessage()], $e->getCode() ?? 422);
        }
    }
}
