<?php

declare(strict_types=1);

namespace State\Interfaces;

use app\Response;

interface BookingState
{
    public function previousState(): Response;

    public function prepareRefundRequest(): Response;

    public function preparePayRequest(): Response;
}