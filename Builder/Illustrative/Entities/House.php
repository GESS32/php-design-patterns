<?php

declare(strict_types=1);

namespace App\Builder\Illustrative\Entities;

use App\Builder\Illustrative\Enums\HouseTypeEnum;
use App\Builder\Illustrative\Interfaces\PoolInterface;
use App\Builder\Illustrative\Interfaces\SaunaInterface;
use Exception;
use Stringable;

/**
 * Дом - это продукт, который порождается строителем.
 * Дом может содержать бассейн и сауну, но они не являются обязательными.
 */
class House implements Stringable
{
    private array $guestsList = [];

    /**
     * Пример отличных от Отеля свойств.
     */
    public function __construct(
        private readonly HouseTypeEnum $type,
        private readonly ?PoolInterface $pool,
        private readonly ?SaunaInterface $sauna,
        private readonly int $seats,
    ) {}

    /**
     * Пригласить гостя на отдых.
     * Пример отличительного поведения от Отеля.
     *
     * @see Hotel
     *
     * @throws Exception
     */
    public function inviteGuest(array $person): void
    {
        if (count($this->guestsList) + 1 > $this->seats) {
            throw new Exception('No more seats available');
        }

        $this->guestsList[] = $person;
    }

    public function __toString(): string
    {
        $type = match ($this->type) {
            HouseTypeEnum::COUNTRY => 'country',
            HouseTypeEnum::TOWN => 'town',
            HouseTypeEnum::VILLAGE => 'village',
        };

        $description = "A $type house with $this->seats seats";
        $guests = count($this->guestsList);

        if ($this->pool) {
            $description .= ", a $this->pool";
        }

        if ($this->sauna) {
            $description .= " and a $this->sauna";
        }

        $description .= ".\nThere are currently $guests guest(s).";

        if ($guests > 0) {
            $list = json_encode($this->guestsList, JSON_PRETTY_PRINT);
            $description .= "\nGuest list: $list";
        }

        return $description;
    }
}