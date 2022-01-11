<?php

declare(strict_types=1);

namespace State\Interfaces;

use app\Response;

interface BookingContext extends BookingEntity
{
    public function transitionStateTo(BookingState $state): void;

    public function cancelOperation(): Response;

    public function getRefundRoute(): Response;

    public function getPayRoute(): Response;
}