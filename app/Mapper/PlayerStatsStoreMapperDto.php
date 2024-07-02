<?php

namespace App\Mapper;

use App\Mapper\Mapper;

class PlayerStatsStoreMapperDto extends Mapper{
    protected static function mapping(): ?array
    {
        return [
            "speed"  => "speed",
            "strength"  => "strength",
            "reflex"  => "reflex",
            "energy"  => "energy"
        ];
    }
}



