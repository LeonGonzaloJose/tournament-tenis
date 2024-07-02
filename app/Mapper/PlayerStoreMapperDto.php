<?php

namespace App\Mapper;

use App\Mapper\Mapper;

class PlayerStoreMapperDto extends Mapper{
    protected static function mapping(): ?array
    {
        return [
            'id' => 'id',
            'name'=> 'name',
            "age" => "age",
            "sex" => "sex",
            "status" => "status",
            "level" => "level"
        ];
    }
}