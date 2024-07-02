<?php

namespace App\Dto\Tournament;

use App\Dto\BaseDto;

class TournamentIndexRequestDto extends BaseDto
{
    protected null|int|string $winner_id = null;
    protected null|string $name = null;
    protected null|string $sex = null;

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

    /**
     * Get the value of winner_id
     */ 
    public function getWinner_id()
    {
        return $this->winner_id;
    }
}