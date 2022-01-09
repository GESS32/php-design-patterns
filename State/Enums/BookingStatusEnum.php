<?php

declare(strict_types=1);

namespace State\Enums;

interface BookingStatusEnum
{
    public const CLOSED = 0;
    public const PAYMENT_PENDING = 1;
    public const PAID = 2;
    public const FAILED = 3;
    public const REFUND_PENDING = 4;
    public const REFUNDED = 5;
}