<?php

declare(strict_types=1);

namespace State\Factories;

use LogicException;
use State\EnumObjects\BookingStatus;
use State\Interfaces\BookingState;
use State\Mappings\BookingStatusStateMapping;

final class BookingStateFactory
{
    /**
     * @param BookingStatus $status
     * @param BookingStatusStateMapping $mapping
     * @return BookingState
     *@throws LogicException
     */
    public static function make(BookingStatus $status, BookingStatusStateMapping $mapping): BookingState
    {
        $stateClass = $mapping->getStateClassByStatus($status->getValue());

        if (class_exists($stateClass)) {
            $object = new $stateClass();
        } else {
            throw new LogicException('Class "' . $stateClass . '" does not exist');
        }

        if (!$object instanceof BookingState) {
            throw new LogicException('The "' . $stateClass . '" should implement the ' . BookingState::class);
        }

        return $object;
    }
}