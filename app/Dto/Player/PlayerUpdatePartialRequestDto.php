<?php

namespace App\Dto\Player;

use App\Dto\BaseDto;

class PlayerUpdatePartialRequestDto extends BaseDto
{
    protected int|string $id;
    protected null|string $name = null;
    protected null|string|int $age = null;
    protected null|string $status = null;
    protected null|string $sex = null;
    protected null|string|int $level = null;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
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
     * Get the value of sex
     */ 
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Get the value of level
     */ 
    public function getLevel()
    {
        return $this->level;
    }
}