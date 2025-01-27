<?php

declare(strict_types=1);

namespace App\Builder\Illustrative\Entities;

use App\Builder\Illustrative\Interfaces\PoolInterface;

class FramePool implements PoolInterface
{
    public function __toString(): string
    {
        return 'frame pool';
    }
}
