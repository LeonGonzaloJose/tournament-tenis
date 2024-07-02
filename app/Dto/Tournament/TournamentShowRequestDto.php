<?php

namespace App\Dto\Tournament;

use App\Dto\BaseDto;

class TournamentShowRequestDto extends BaseDto
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