<?php

namespace App\Dto\Tournament\Response;

use App\Dto\BaseDto;

class TournamentResponseDto extends BaseDto
{
    protected int $id;
    protected string $name;
    protected int $participants;
    protected string $sex;
    protected int $winner;
    protected string $created;
}