<?php

declare(strict_types=1);

namespace State\Factories;

use LogicException;
use State\Dto\BookingDto;
use State\Entities\Booking;
use State\EnumObjects\BookingStatus;
use State\Mappings\BookingStatusStateMapping;

final class BookingFactory
{
    public static function make(BookingDto $dto, BookingStatusStateMapping $mapping): ?Booking
    {
        try {
            $status = new BookingStatus($dto->status);
            $state = BookingStateFactory::make($status, $mapping);
        } catch (LogicException $exception) {
            return null;
        }

        $booking = new Booking($state);

        $booking->setCustomerName($dto->customerName);
        $booking->setCustomerPhone($dto->customerPhone);
        $booking->setAmount($dto->amount);
        $booking->setCreatedAt($dto->createdAt);
        $booking->setUpdatedAt($dto->updatedAt);
        $booking->setRefundApprovedAt($dto->refundApprovedAt);

        return $booking;
    }
}