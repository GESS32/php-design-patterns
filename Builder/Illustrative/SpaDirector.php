<?php

declare(strict_types=1);

namespace App\Builder\Illustrative;

use App\Builder\Illustrative\Entities\FramePool;
use App\Builder\Illustrative\Entities\HammamSauna;
use App\Builder\Illustrative\Entities\ProfessionalSwimmingPool;
use App\Builder\Illustrative\Entities\RomanSauna;
use App\Builder\Illustrative\Interfaces\SpaBuilderInterface;

class SpaDirector
{
    /**
     * Директор должен работать со строителем через интерфейс.
     */
    public function __construct(public SpaBuilderInterface $builder) {}

    /**
     * Директор может строить несколько вариаций продукта.
     * Директор не должен возвращать результат (продукт), он отвечает только за его конструирование.
     */
    public function constructMinimal(): void
    {
        $this->builder
            ->reset()
            ->setSauna(new HammamSauna())
            ->setSeats(2);
    }

    public function constructAllInclusive(): void
    {
        $this->builder
            ->reset()
            ->setPool(new FramePool())
            ->setSauna(new HammamSauna())
            ->setSeats(8);
    }

    public function constructArmenianLuxury(): void
    {
        $this->builder
            ->reset()
            ->setPool(new ProfessionalSwimmingPool())
            ->setSauna(new RomanSauna())
            ->setSeats(16)
            ->getResult();
    }
}