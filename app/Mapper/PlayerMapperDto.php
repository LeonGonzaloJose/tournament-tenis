<?php

namespace App\Mapper;

use App\Mapper\Mapper;

class PlayerMapperDto extends Mapper{
    protected static function mapping(): ?array
    {
        return [
            'id' => 'id',
            'name'=> 'name',
            "age" => "age",
            "sex" => "sex",
            "status" => "status",
            "level" => "level",
            "speed"  => "speed",
            "strength"  => "strength",
            "reflex"  => "reflex",
            "energy"  => "energy"
        ];
    }
}