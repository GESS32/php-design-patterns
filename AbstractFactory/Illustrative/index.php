<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use App\AbstractFactory\Illustrative\Factories\CarLexusAbstractFactory;
use App\AbstractFactory\Illustrative\Factories\CarRenaultAbstractFactory;
use App\AbstractFactory\Illustrative\Interfaces\CarAbstractFactoryInterface;
use App\AbstractFactory\Illustrative\Services\CarManufacturer;

/**
 * Клиентский код должен работать только с интерфейсами фабрик.
 * Поэтому конкретные классы фабрик обычно определяются во время запуска приложения, например в зависимости от ENV.
 * В контексте серверной разработки конкретная фабрика также может быть определена на этапе обработки запроса.
 */
function clientCode(CarAbstractFactoryInterface $factory): void
{
    try {
        $manufacturer = new CarManufacturer($factory);
        $car = $manufacturer->releaseCar();

        $car->showPassport();
    } catch (Exception $exception) {
        echo $exception->getMessage();
        echo PHP_EOL;
    }
}

clientCode(new CarLexusAbstractFactory());
clientCode(new CarRenaultAbstractFactory());
