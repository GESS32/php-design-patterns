<?php

declare(strict_types=1);

namespace State\Services;

use State\Entities\BookingEntity;
use State\Interfaces\BookingStateContext;
use State\States\AbstractBookingState;

class BookingUpdateStatus implements BookingStateContext
{
    protected AbstractBookingState $state;
    protected BookingEntity $entity;

    public function __construct(AbstractBookingState $state, BookingEntity &$entity)
    {
        $this->entity = &$entity;

        $this->transitionTo($state);
    }

    public function transitionTo(AbstractBookingState $state): void
    {
        $this->state = $state;

        $this->state->setContext($this);
    }

    public function updateBookingEntityState(): BookingEntity
    {
        $this->state->updateEntity($this->entity);

        return $this->entity;
    }

    public function showCurrentStateInfo(): void
    {
        $this->state->showLog();
    }
}