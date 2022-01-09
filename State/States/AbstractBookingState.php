<?php

declare(strict_types=1);

namespace State\States;

use State\Interfaces\BookingContext;
use State\Interfaces\BookingState;

abstract class AbstractBookingState implements BookingState
{
    protected BookingContext $context;
    protected ?int $status;

    public function __construct(BookingContext $context)
    {
        $this->setContext($context);
    }

    public function setContext(BookingContext $context): void
    {
        $this->context = $context;
    }
}