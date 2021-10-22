<?php

declare(strict_types=1);

namespace State\States;

use State\Entities\BookingEntity;
use State\Enums\BookingStatusEnum;

final class BookingRefundPending extends AbstractBookingState
{
    public function updateEntity(BookingEntity $entity): void
    {
        $entity->status = BookingStatusEnum::REFUND_PENDING;

        $this->addOperationLog('Status changed to REFUND PENDING');
    }
}