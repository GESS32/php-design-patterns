<?php

declare(strict_types=1);

namespace App\Builder\Illustrative\Builders;

use App\Builder\Illustrative\Entities\House;
use App\Builder\Illustrative\Enums\HouseTypeEnum;
use App\Builder\Illustrative\Interfaces\SpaBuilderInterface;
use App\Builder\Illustrative\Interfaces\PoolInterface;
use App\Builder\Illustrative\Interfaces\SaunaInterface;

class HouseBuilder implements SpaBuilderInterface
{
    private int $seats;
    private ?SaunaInterface $sauna;
    private ?PoolInterface $pool;

    /**
     * Строитель может принимать обязательные для построения продукта параметры в конструкторе.
     */
    public function __construct(public HouseTypeEnum $type)
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
        $this->seats = $quantity;
        return $this;
    }

    public function getResult(): House
    {
        return new House($this->type, $this->pool, $this->sauna, $this->seats);
    }

    public function reset(): static
    {
        $this->seats = 1;
        $this->pool = null;
        $this->sauna = null;

        return $this;
    }
}