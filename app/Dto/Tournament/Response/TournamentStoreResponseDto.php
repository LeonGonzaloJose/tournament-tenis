<?php

namespace App\Dto\Tournament\Response;

use App\Dto\BaseDto;

class TournamentStoreResponseDto extends BaseDto
{
    protected int $id;
    protected string $name;
    protected int $participants;
    protected string $sex;
    protected int $winner;
    protected string $players_name;
    protected int $age;
    protected int $level;
}