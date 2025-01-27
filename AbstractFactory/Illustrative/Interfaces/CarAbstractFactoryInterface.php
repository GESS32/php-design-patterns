<?php

declare(strict_types=1);

namespace App\AbstractFactory\Illustrative\Interfaces;

interface CarAbstractFactoryInterface
{
    public function body(): CarBodyInterface;

    public function interior(): CarInteriorInterface;

    public function transmission(): CarTransmissionInterface;

    public function engine(): CarEngineInterface;
}
