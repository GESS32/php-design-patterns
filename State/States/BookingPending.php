<?php

declare(strict_types=1);

namespace State\States;

use State\Entities\BookingEntity;
use State\Enums\BookingStatusEnum;

final class BookingPending extends AbstractBookingState
{
    public function updateEntity(BookingEntity $entity): void
    {
        $entity->status = BookingStatusEnum::PENDING;

        $this->addOperationLog('Status changed to PENDING');
    }
}