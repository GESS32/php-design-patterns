<?php

declare(strict_types=1);

namespace App\Builder\Illustrative\Entities;

use App\Builder\Illustrative\Interfaces\SaunaInterface;

class RomanSauna implements SaunaInterface
{
    public function __toString(): string
    {
        return 'Roman sauna';
    }
}