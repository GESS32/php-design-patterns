<?php

declare(strict_types=1);

namespace State\Interfaces;

use State\States\AbstractBookingState;

interface BookingStateContext
{
    public function transitionTo(AbstractBookingState $state): void;
}