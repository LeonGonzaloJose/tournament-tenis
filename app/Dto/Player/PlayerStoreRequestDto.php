<?php

namespace App\Dto\Player;

use App\Dto\BaseDto;

class PlayerStoreRequestDto extends BaseDto
{
    protected string $name;
    protected string $sex;
    protected null|string|int $age = null;
    protected null|string $status;
    protected null|string|int $level;


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
     * Get the value of age
     */ 
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of level
     */ 
    public function getLevel()
    {
        return $this->level;
    }
}