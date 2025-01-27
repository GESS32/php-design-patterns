<?php

declare(strict_types=1);

namespace App\AbstractFactory\Illustrative\Services;

use App\AbstractFactory\Illustrative\Entities\Car;
use App\AbstractFactory\Illustrative\Interfaces\CarAbstractFactoryInterface;
use Exception;

/**
 * Производитель автомобилей.
 */
class CarManufacturer
{
    /**
     * Клиентский код должен работать с фабриками только через их общие интерфейсы.
     */
    public function __construct(public CarAbstractFactoryInterface $carFactory) {}

    /**
     * Пример бизнес логики клиента фабрики:
     * производитель создает автомобиль из семейства объектов - комплектующих, которые предоставляет фабрика.
     *
     * @throws Exception
     */
    public function releaseCar(): Car
    {
        return new Car(
            $this->carFactory->body(),
            $this->carFactory->interior(),
            $this->carFactory->transmission(),
            $this->carFactory->engine(),
            (string) random_int(1000, 9999),
            (int) date('Y'),
        );
    }
}
