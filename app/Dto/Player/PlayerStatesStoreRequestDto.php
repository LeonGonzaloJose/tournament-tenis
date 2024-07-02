<?php

namespace App\Dto\Player;

use App\Dto\BaseDto;

class PlayerStatesStoreRequestDto extends BaseDto
{
    protected int $speed;
    protected int $strength;
    protected int $reflex;
    protected int $energy;

    /**
     * Get the value of speed
     */ 
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Get the value of strength
     */ 
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * Get the value of reflex
     */ 
    public function getReflex()
    {
        return $this->reflex;
    }

    /**
     * Get the value of energy
     */ 
    public function getEnergy()
    {
        return $this->energy;
    }
}