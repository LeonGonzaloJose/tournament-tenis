<?php

namespace App\Dto\Player\Response;

use App\Dto\BaseDto;

class PlayerStatesStoreResponseDto extends BaseDto
{
    protected int $speed;
    protected int $strength;
    protected int $reflex;
    protected int $energy;
}