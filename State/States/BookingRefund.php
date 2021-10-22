<?php

declare(strict_types=1);

namespace State\States;

use State\Entities\BookingEntity;
use State\Enums\BookingStatusEnum;

final class BookingRefund extends AbstractBookingState
{
    public function updateEntity(BookingEntity $entity): void
    {
        $enum = new BookingStatusEnum($entity->status);

        if ($enum->isNot(BookingStatusEnum::PAID) || !$entity->hasTransaction) {
            $this->addOperationLog('Cannot make refund');
        } else {
            $entity->status = BookingStatusEnum::REFUNDED;
            $this->addOperationLog('Status changed to REFUNDED');
        }
    }
}