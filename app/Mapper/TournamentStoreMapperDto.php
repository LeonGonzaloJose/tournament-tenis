<?php

namespace App\Mapper;

use App\Mapper\Mapper;

class TournamentStoreMapperDto extends Mapper{
    protected static function mapping(): ?array
    {
        return [
            'id' => 'id',
            'name'=> 'name',
            "participants" => "participants",
            "sex" => "sex",
            "winner" => "winner",
            "players_name"  => "players_name",
            "age"  => "age",
            "level"  => "level",
        ];
    }
}