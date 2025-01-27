<?php

declare(strict_types=1);

namespace App\AbstractFactory\Illustrative\Entities;

use App\AbstractFactory\Illustrative\Interfaces\CarBodyInterface;
use App\AbstractFactory\Illustrative\Interfaces\CarEngineInterface;
use App\AbstractFactory\Illustrative\Interfaces\CarInteriorInterface;
use App\AbstractFactory\Illustrative\Interfaces\CarTransmissionInterface;

/**
 * Класс "автомобиль" зависит от абстракций "двигатель", "трансмиссия", "кузов" и "интерьер".
 * Эти абстракции являются семейством связанных продуктов, которые могут быть созданы фабрикой.
 */
readonly class Car
{
    /**
     * Клиентский код должен работать с продуктами фабрики только через их общие интерфейсы.
     */
    public function __construct(
        private CarBodyInterface $body,
        private CarInteriorInterface $interior,
        private CarTransmissionInterface $transmission,
        private CarEngineInterface $engine,
        private string $licenseValue,
        private int $releaseYear
    ) {}

    public function showPassport(): void
    {
        $engine = $this->engine::class;
        $transmission = $this->transmission::class;
        $body = $this->body::class;
        $interior = $this->interior::class;

        echo "---\n";
        echo "Engine: $engine\n";
        echo "Transmission: $transmission\n";
        echo "Body: $body\n";
        echo "Interior: $interior\n";
        echo "License value: $this->licenseValue\n";
        echo "Release year: $this->releaseYear\n";
        echo "---\n\n";
    }
}
