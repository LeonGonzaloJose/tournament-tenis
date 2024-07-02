<?php

namespace App\Services;

use App\Dto\Tournament\{TournamentIndexRequestDto, TournamentShowRequestDto, TournamentStoreRequestDto};
use App\Dto\Tournament\Response\TournamentResponseDto;
use App\Dto\Tournament\Response\TournamentStoreResponseDto;
use App\Mapper\Mapper;
use App\Mapper\TournamentMapperDto;
use App\Mapper\TournamentStoreMapperDto;
use App\Repository\{MatchesRepository, TournamentRepository, PlayersRepository};
use Exception;

class TournamentService{

    private TournamentRepository $tournamentRepository;
    protected PlayersRepository $playersRepository;
    protected MatchesRepository $matchesRepository;
    private object $player_winner;

    public function __construct(PlayersRepository $playersRepository, TournamentRepository $tournamentRepository, MatchesRepository $matchesRepository)
    {
        $this->playersRepository = $playersRepository;
        $this->tournamentRepository = $tournamentRepository;
        $this->matchesRepository = $matchesRepository;
    }

    public function index(TournamentIndexRequestDto $request){
        $result = $this->tournamentRepository->index($request);

        $result->transform(function ($player){
            return Mapper::mapResponse($player, TournamentMapperDto::class, TournamentResponseDto::class);
        });

        return $result->toArray();
    }

    public function show(TournamentShowRequestDto $request){
        return Mapper::mapResponse($this->tournamentRepository->show($request), TournamentMapperDto::class, TournamentResponseDto::class);
    }

    public function store(TournamentStoreRequestDto $request)
    {
        $numPlayers = 1;

        $sex = $request->getSex();
        $players = $this->playersRepository->getParticipants($sex);

        $totalPlayers = $players->count();

        if ($totalPlayers < 2) {
            throw new Exception('Se necesitan como mínimo 2 jugadores/jugadoras', 422);
        }

        while ($numPlayers * 2 <= $totalPlayers) {
            $numPlayers *= 2;
        }

        $playerList = $players->shuffle()->take($numPlayers)->values();
        $tournament = $this->tournamentRepository->store($request, $numPlayers);

        while ($numPlayers > 1) {
            $matchs_siguientes = [];

            for ($i = 0; $i < $numPlayers; $i += 2) {
                if ($sex == 'M') {
                    $this->determineWinnerMale($playerList[$i], $playerList[$i + 1]);
                    $matchs_siguientes[] = $this->player_winner;
                } else {
                    $this->determineWinnerFemale($playerList[$i], $playerList[$i + 1]);
                    $matchs_siguientes[] = $this->player_winner;
                }
    
                $this->matchesRepository->store($tournament->id, $playerList[$i]->id, $playerList[$i + 1]->id, $this->player_winner->id);
            }

            $playerList = $matchs_siguientes;
            $numPlayers = count($playerList);
        }

        return Mapper::mapResponse(
            $this->tournamentRepository->update($tournament->id, $this->player_winner->id),
            TournamentStoreMapperDto::class,
            TournamentStoreResponseDto::class
        );
    }

    private function determineWinnerMale($player1, $player2)
    {
        $scorePlayerOne = ($player1->strength + $player1->speed) * $this->luckCalculator($player1->energy);
        $scorePlayerTwo = ($player2->strength + $player2->speed) * $this->luckCalculator($player2->energy);

        $this->player_winner = ($scorePlayerOne > $scorePlayerTwo) ? $player1 : $player2;
    }

    private function determineWinnerFemale($player1, $player2)
    {
        $scorePlayerOne = $player1->reflex * $this->luckCalculator($player1->energy);
        $scorePlayerTwo = $player2->reflex * $this->luckCalculator($player2->energy);

        $this->player_winner = ($scorePlayerOne > $scorePlayerTwo) ? $player1 : $player2;
    }

    private function luckCalculator($energy){
        return $energy * mt_rand(80, 120) / 100;
    }

}