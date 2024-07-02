<?php

namespace App\Http\Controllers;

use App\Dto\Tournament\{TournamentIndexRequestDto, TournamentShowRequestDto, TournamentStoreRequestDto};
use App\Http\Requests\Tournament\{TournamentIndexRequest, TournamentShowRequest, TournamentStoreRequest};
use App\Services\TournamentService;
use Exception;


class TournamentController extends Controller
{

    private TournamentService $tournamentService;

    public function __construct(TournamentService $service)
    {
        $this->tournamentService = $service;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/tournament",
     *      tags={"tournaments"},
     *      operationId="tournament_index",
     *      summary="Obtiene un listado de torneos",
     *      security={
     *          {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          description="Nombre del torneo",
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="sex",
     *          in="query",
     *          description="Sexo de los jugadores",
     *          @OA\Schema(
     *              type="string",
     *              enum={"M", "F"},
     *              description="M = Masculino, F = Femenino"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="winner_id",
     *          in="query",
     *          description="Identificador del ganador",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200, description="Success"),
     *      @OA\Response(response=404, description="Player not found")
     * )
     */
    public function index(TournamentIndexRequest $request)
    {
        try {
            $response = $this->tournamentService->index(new TournamentIndexRequestDto($request->all()));
           
            return response()->json(["status"=> "succes", "message"=> "Lista de torneos obtenido con exito", "date"=> $response], 200);
        } catch (Exception $e) {
            return response($e->getMessage(), $e->getCode()?? 422);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/v1/tournament",
     *      tags={"tournaments"},
     *      operationId="tournament_store",
     *      summary="Crea y ejecuta un torneo",
     *      security={
     *          {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          description="Nombre del torneo",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="sex",
     *          in="query",
     *          description="Sexualidad de los jugadores",
     *          @OA\Schema(
     *              type="string",
     *              enum={"M", "F"},
     *              description="M = Masculino, F = Femenino"
     *          )
     *      ),
     *      @OA\Response(response=201,description="Success")
     * )
     */
    public function store(TournamentStoreRequest $request)
    {
        try {
            $response = $this->tournamentService->store(new TournamentStoreRequestDto($request->all()));
           
            return response()->json(["status"=> "succes", "message"=> "Torneo creado con exito", "date"=> $response], 201);

        } catch (Exception $e) {
            return response($e->getMessage(), $e->getCode()?? 422);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/v1/tournament/{id}",
     *      tags={"tournaments"},
     *      operationId="tournament_show",
     *      summary="Obtiene los datos de un torneo",
     *      security={
     *          {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Identificador del torneo",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200, description="Success"),
     *      @OA\Response(response=404, description="Player not found")
     * )
     */
    public function show(TournamentShowRequest $request)
    {
        try {
            $response = $this->tournamentService->show(new TournamentShowRequestDto($request->all()));
           
            return response()->json(["status"=> "succes", "message"=> "Torneo obtenido con exito", "date"=> $response], 200);
        } catch (Exception $e) {
            return response($e->getMessage(), $e->getCode()?? 422);
        }
    }
}
