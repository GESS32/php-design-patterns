<?php

declare(strict_types=1);

namespace App\Builder\Illustrative\Builders;

use App\Builder\Illustrative\Entities\Hotel;
use App\Builder\Illustrative\Interfaces\SpaBuilderInterface;
use App\Builder\Illustrative\Interfaces\PoolInterface;
use App\Builder\Illustrative\Interfaces\SaunaInterface;

class HotelBuilder implements SpaBuilderInterface
{
    private int $rooms;
    private ?SaunaInterface $sauna;
    private ?PoolInterface $pool;

    public function __construct()
    {
        $this->reset();
    }

    public function setPool(PoolInterface $entity): static
    {
        $this->pool = $entity;
        return $this;
    }

    public function setSauna(SaunaInterface $entity): static
    {
        $this->sauna = $entity;
        return $this;
    }

    public function setSeats(int $quantity): static
    {
        $this->rooms = $quantity;
        return $this;
    }

    public function getResult(): Hotel
    {
        return new Hotel($this->pool, $this->sauna, $this->rooms);
    }

    public function reset(): static
    {
        $this->rooms = 1;
        $this->pool = null;
        $this->sauna = null;

        return $this;
    }
}