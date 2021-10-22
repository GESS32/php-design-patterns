<?php

declare(strict_types=1);

namespace State\Factories;

use LogicException;
use State\Enums\BookingStatusEnum;
use State\States\AbstractBookingState;

final class BookingStateFactory
{
    public static function make(BookingStatusEnum $enum): AbstractBookingState
    {
        $class = $enum->getStateClass();

        if (class_exists($class)) {
            $object = new $class();
        } else {
            throw new LogicException('Class "' . $class . '" does not exist');
        }

        if (!$object instanceof AbstractBookingState) {
            throw new LogicException('The "' . $class . '" should be instance of ' . AbstractBookingState::class);
        }

        return $object;
    }
}