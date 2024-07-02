<?php

namespace App\Dto\Player\Response;

use App\Dto\BaseDto;

class PlayerResponseDto extends BaseDto
{
    protected int $id;
    protected string $name;
    protected int $age;
    protected string $sex;
    protected string $status;
    protected int $level;
    protected int $speed;
    protected int $strength;
    protected int $reflex;
    protected int $energy;
}