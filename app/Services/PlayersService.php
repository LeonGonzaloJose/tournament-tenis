<?php

namespace App\Services;

use App\Dto\Player\{PlayerDeleteRequestDto, PlayerIndexRequestDto, PlayerShowRequestDto, PlayerStatesStoreRequestDto, PlayerStoreRequestDto, PlayerUpdatePartialRequestDto, PlayerUpdateRequestDto};
use App\Dto\Player\Response\PlayerResponseDto;
use App\Dto\Player\Response\PlayerStatesStoreResponseDto;
use App\Dto\Player\Response\PlayerStoreResponseDto;
use App\Helpers\Helper;
use App\Repository\PlayersRepository;
use App\Mapper\{Mapper, PlayerMapperDto, PlayerStatsStoreMapperDto, PlayerStoreMapperDto};
use App\Repository\PlayersStatsRepository;

class PlayersService{

    private PlayersRepository $playerRepository;

    public function __construct(PlayersRepository $repository)
    {
        $this->playerRepository = $repository;
    }

    public function index(PlayerIndexRequestDto $request){
        $result = $this->playerRepository->index($request);

        $result->transform(function ($player){
            return Mapper::mapResponse($player, PlayerMapperDto::class, PlayerResponseDto::class);
        });

        return $result->toArray();
    }

    public function show(PlayerShowRequestDto $request){
        return Mapper::mapResponse($this->playerRepository->show($request), PlayerMapperDto::class, PlayerResponseDto::class);
    }

    public function store(PlayerStoreRequestDto $request){
        $stats = Helper::generateStats($request->getLevel());

        $new_player = $this->playerRepository->store($request);

        $new_player_stats = PlayersStatsRepository::store($new_player->id, new PlayerStatesStoreRequestDto($stats));
        
        return array_merge(
            Mapper::mapResponse($new_player, PlayerStoreMapperDto::class, PlayerStoreResponseDto::class),
            Mapper::mapResponse($new_player_stats, PlayerStatsStoreMapperDto::class, PlayerStatesStoreResponseDto::class)
        );
    }

    public function update(PlayerUpdateRequestDto $request){
        return Mapper::mapResponse($this->playerRepository->update($request), PlayerStoreMapperDto::class, PlayerStoreResponseDto::class);
    }

    public function updatePartial(PlayerUpdatePartialRequestDto $request){
        return Mapper::mapResponse($this->playerRepository->updatePartial($request), PlayerStoreMapperDto::class, PlayerStoreResponseDto::class);
    }

    public function destroy(PlayerDeleteRequestDto $request){
        return $this->playerRepository->destroy($request);
    }
}