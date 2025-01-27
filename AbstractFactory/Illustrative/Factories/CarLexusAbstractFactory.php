<?php

declare(strict_types=1);

namespace App\AbstractFactory\Illustrative\Factories;

use App\AbstractFactory\Illustrative\Entities\PremiumBody;
use App\AbstractFactory\Illustrative\Entities\PremiumEngine;
use App\AbstractFactory\Illustrative\Entities\PremiumInterior;
use App\AbstractFactory\Illustrative\Entities\PremiumTransmission;
use App\AbstractFactory\Illustrative\Interfaces\CarAbstractFactoryInterface;
use App\AbstractFactory\Illustrative\Interfaces\CarBodyInterface;
use App\AbstractFactory\Illustrative\Interfaces\CarEngineInterface;
use App\AbstractFactory\Illustrative\Interfaces\CarInteriorInterface;
use App\AbstractFactory\Illustrative\Interfaces\CarTransmissionInterface;

/**
 * Конкретная фабрика Lexus, которая создает семейство объектов премиум-класса.
 */
class CarLexusAbstractFactory implements CarAbstractFactoryInterface
{
    public function body(): CarBodyInterface
    {
        return new PremiumBody();
    }

    public function interior(): CarInteriorInterface
    {
        return new PremiumInterior();
    }

    public function transmission(): CarTransmissionInterface
    {
        return new PremiumTransmission();
    }

    public function engine(): CarEngineInterface
    {
        return new PremiumEngine();
    }
}
