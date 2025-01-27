<?php

declare(strict_types=1);

namespace App\Builder\Illustrative\Entities;

use App\Builder\Illustrative\Interfaces\PoolInterface;
use App\Builder\Illustrative\Interfaces\SaunaInterface;
use DateInterval;
use Exception;

/**
 * Отель - это продукт, который порождается строителем.
 * Отель может содержать бассейн и сауну, но они не являются обязательными.
 */
class Hotel
{
    private array $bookings = [];

    public function __construct(
        public ?PoolInterface $pool,
        public ?SaunaInterface $sauna,
        public int $rooms,
    ) {}

    /**
     * Забронировать номер на проживание.
     * Пример отличительного поведения от "House".
     *
     * @see House
     *
     * @throws Exception
     */
    public function bookRoom(DateInterval $interval, array $tenant): void
    {
        if (count($this->bookings) + 1 > $this->rooms) {
            throw new Exception('No more rooms available');
        }

        $this->bookings[] = [
            'interval' => $interval,
            'tenant' => $tenant,
        ];
    }

    public function __toString(): string
    {
        $description = "A hotel with $this->rooms rooms";
        $roomsAvailable = $this->rooms - count($this->bookings);

        if ($this->pool) {
            $description .= ", a $this->pool";
        }

        if ($this->sauna) {
            $description .= " and a $this->sauna";
        }

        $description .= ".\nAvailable $roomsAvailable room(s) for booking.";

        return $description;
    }
}