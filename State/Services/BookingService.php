<?php

declare(strict_types=1);

namespace State\Services;

use State\Dto\BookingDto;
use State\Entities\Booking;
use State\Factories\BookingFactory;
use State\Mappings\BookingStatusStateMapping;

class BookingService
{
    public function storeBooking(BookingDto $bookingDto, BookingStatusStateMapping $mapping): ?Booking
    {
        return BookingFactory::make(
            $bookingDto,
            $mapping
        );
    }

    public function approveRefund(Booking $booking): Booking
    {

    }

    public function pay(Booking $booking, float $amount): Booking
    {
        $booking->setAmount($amount);
    }

    public function refund(Booking $booking): Booking
    {

    }
}