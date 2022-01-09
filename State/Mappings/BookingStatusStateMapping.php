<?php

declare(strict_types=1);

namespace State\Mappings;

use State\EnumObjects\BookingStatus;
use State\States\BookingClosed;
use State\States\BookingFailed;
use State\States\BookingPaid;
use State\States\BookingPendingForPayment;
use State\States\BookingPendingForRefund;
use State\States\BookingRefund;

class BookingStatusStateMapping
{
    protected array $statusesStates = [
        BookingStatus::CLOSED => BookingClosed::class,
        BookingStatus::PAYMENT_PENDING => BookingPendingForPayment::class,
        BookingStatus::PAID => BookingPaid::class,
        BookingStatus::FAILED => BookingFailed::class,
        BookingStatus::REFUND_PENDING => BookingPendingForRefund::class,
        BookingStatus::REFUNDED => BookingRefund::class,
    ];

    public function getStateClassByStatus(BookingStatus $status): ?string
    {
        return $this->statusesStates[$status->getValue()] ?? null;
    }

    public function getStatusByStateClass(string $stateClass): ?int
    {
        $status = array_search($stateClass, $this->statusesStates);

        if ($status === false) {
            return null;
        }

        return $status;
    }
}