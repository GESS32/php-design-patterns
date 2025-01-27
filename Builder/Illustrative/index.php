<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Builder\Illustrative\SpaDirector;
use App\Builder\Illustrative\Builders\HotelBuilder;
use App\Builder\Illustrative\Builders\HouseBuilder;
use App\Builder\Illustrative\Enums\HouseTypeEnum;

/**
 * Клиентский код создаёт объект-строитель и передаёт его директору.
 */
$houseBuilder = new HouseBuilder(HouseTypeEnum::COUNTRY);

/**
 * Отдельный класс директора не является строго обязательным.
 * Клиент может контролировать строителя напрямую.
 *
 * Директор полезен, если есть несколько способов конструирования продуктов,
 * отличающихся порядком и наличием шагов конструирования.
 */
$director = new SpaDirector($houseBuilder);

/**
 * Конструируем и порождаем загородный дом с минимальным набором спа функций.
 */
$director->constructMinimal();
$countryHouse = $houseBuilder->getResult();

/**
 * Конструируем и порождаем городской дом с полным набором спа функций.
 */
$houseBuilder->type = HouseTypeEnum::TOWN;
$director->constructAllInclusive();
$townHouse = $houseBuilder->getResult();

/**
 * Демонстрация уникальной бизнес-логики объекта House:
 * приглашаем гостей в загородный дом и городской дом.
 */
try {
    $countryHouse->inviteGuest(['Friend']);
    $countryHouse->inviteGuest(['Girlfriend']);

    for ($index = 1; $index < 6; $index++) {
        $townHouse->inviteGuest(["Friend $index"]);
    }
} catch (Exception $exception) {
    echo PHP_EOL;
    echo $exception->getMessage();
    echo PHP_EOL;
}

/**
 * Создаём строителя отеля и передаём его директору.
 */
$hotelBuilder = new HotelBuilder();
$director->builder = $hotelBuilder;

/**
 * Конструируем и порождаем отель с роскошным набором спа функций.
 */
$director->constructArmenianLuxury();
$armenianHotel = $hotelBuilder->getResult();

/**
 * Демонстрация уникальной бизнес-логики объекта Hotel:
 * бронируем номера в отеле.
 */
try {
    $armenianHotel->bookRoom(DateInterval::createFromDateString('1 day'), ['Person 1']);
    $armenianHotel->bookRoom(DateInterval::createFromDateString('3 days'), ['Person 2']);
    $armenianHotel->bookRoom(DateInterval::createFromDateString('3 days'), ['Person 3']);
} catch (Exception $exception) {
    echo PHP_EOL;
    echo $exception->getMessage();
    echo PHP_EOL;
}

/**
 * Выводим информацию о каждом продукте для проверки результата работы с фабриками:
 */
echo '---';
echo PHP_EOL;

foreach ([$countryHouse, $townHouse, $armenianHotel] as $product) {
    echo $product;
    echo PHP_EOL;
    echo '---';
    echo PHP_EOL;
}
