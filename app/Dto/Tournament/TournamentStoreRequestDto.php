<?php

namespace App\Dto\Tournament;

use App\Dto\BaseDto;

class TournamentStoreRequestDto extends BaseDto
{
    protected string $name;
    protected string $sex;

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of sex
     */ 
    public function getSex()
    {
        return $this->sex;
    }
}