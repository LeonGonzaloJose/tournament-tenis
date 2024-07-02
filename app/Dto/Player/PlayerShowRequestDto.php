<?php

namespace App\Dto\Player;

use App\Dto\BaseDto;

class PlayerShowRequestDto extends BaseDto
{
    protected string|int $id;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
}