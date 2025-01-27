<?php

declare(strict_types=1);

namespace App\Builder\Illustrative\Entities;

use App\Builder\Illustrative\Interfaces\SaunaInterface;

class FinnishSauna implements SaunaInterface
{
    public function __toString(): string
    {
        return 'Finnish sauna';
    }
}
