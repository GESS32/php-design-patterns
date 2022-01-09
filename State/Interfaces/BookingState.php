<?php

declare(strict_types=1);

namespace State\Interfaces;

use app\Response;

interface BookingState
{
    public function rollbackStatus(): Response;

    public function prepareRefundRequest(): Response;

    public function preparePayRequest(): Response;
}