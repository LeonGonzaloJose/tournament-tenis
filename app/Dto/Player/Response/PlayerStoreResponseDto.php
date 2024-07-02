<?php

namespace App\Dto\Player\Response;

use App\Dto\BaseDto;

class PlayerStoreResponseDto extends BaseDto
{
    protected int $id;
    protected string $name;
    protected int $age;
    protected string $sex;
    protected string $status;
    protected int $level;
}