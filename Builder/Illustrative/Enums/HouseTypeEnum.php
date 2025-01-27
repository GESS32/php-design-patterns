<?php

declare(strict_types=1);

namespace App\Builder\Illustrative\Enums;

enum HouseTypeEnum: int
{
    case COUNTRY = 1;
    case TOWN = 2;
    case VILLAGE = 3;
}
