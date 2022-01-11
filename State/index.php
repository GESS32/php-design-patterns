<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use State\EnumObjects\BookingStatus;
use State\Enums\BookingStatusEnum;

$pendingStatus = new BookingStatus(BookingStatusEnum::PAYMENT_PENDING);
$paidStatus = new BookingStatus(BookingStatusEnum::PAID);
$failedStatus = new BookingStatus(BookingStatusEnum::FAILED);
$refundedStatus = new BookingStatus(BookingStatusEnum::REFUNDED);