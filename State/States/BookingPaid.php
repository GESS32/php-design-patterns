<?php

declare(strict_types=1);

namespace State\States;

use State\Entities\BookingEntity;
use State\Enums\BookingStatusEnum;

final class BookingPaid extends AbstractBookingState
{
    public function updateEntity(BookingEntity $entity): void
    {
        if ($entity->hasTransaction) {
            $entity->status = BookingStatusEnum::PAID;

            $this->addOperationLog('Paid successful');
        } elseif (isYourDay()) {
            $failedState = new BookingFailed();
            $failedState->addOperationLog('Paid failed.');
            $failedState->updateEntity($entity);

            $this->context->transitionTo($failedState);
        } else {
            $pendingState = new BookingPending();
            $pendingState->addOperationLog('Paid failed, but booking time has not out.');
            $pendingState->updateEntity($entity);

            $this->context->transitionTo($pendingState);
        }
    }
}