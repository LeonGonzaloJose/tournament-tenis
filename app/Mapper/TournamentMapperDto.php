<?php

namespace App\Mapper;

use App\Mapper\Mapper;

class TournamentMapperDto extends Mapper{
    protected static function mapping(): ?array
    {
        return [
            'id' => 'id',
            'name'=> 'name',
            "participants" => "participants",
            "sex" => "sex",
            "winner" => "winner",
            "created_at" => "created",
        ];
    }
}