<?php

declare(strict_types=1);

namespace App\AbstractFactory\Illustrative\Factories;

use App\AbstractFactory\Illustrative\Entities\EcoBody;
use App\AbstractFactory\Illustrative\Entities\EcoEngine;
use App\AbstractFactory\Illustrative\Entities\EcoInterior;
use App\AbstractFactory\Illustrative\Entities\EcoTransmission;
use App\AbstractFactory\Illustrative\Interfaces\CarAbstractFactoryInterface;
use App\AbstractFactory\Illustrative\Interfaces\CarBodyInterface;
use App\AbstractFactory\Illustrative\Interfaces\CarEngineInterface;
use App\AbstractFactory\Illustrative\Interfaces\CarInteriorInterface;
use App\AbstractFactory\Illustrative\Interfaces\CarTransmissionInterface;

/**
 * Конкретная фабрика Renault, которая создает семейство объектов эконом-класса.
 */
class CarRenaultAbstractFactory implements CarAbstractFactoryInterface
{
    public function body(): CarBodyInterface
    {
        return new EcoBody();
    }

    public function interior(): CarInteriorInterface
    {
        return new EcoInterior();
    }

    public function transmission(): CarTransmissionInterface
    {
        return new EcoTransmission();
    }

    public function engine(): CarEngineInterface
    {
        return new EcoEngine();
    }
}
