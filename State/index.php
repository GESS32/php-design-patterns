<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use State\Entities\BookingEntity;
use State\Enums\BookingStatusEnum;
use State\Factories\BookingStateFactory;
use State\Services\BookingUpdateStatus;

/**
 * Some conditional event...
 */
function isYourDay(): bool
{
    return (bool) random_int(0, 1);
}

$entity = new BookingEntity();

$pendingEnum = new BookingStatusEnum(BookingStatusEnum::PENDING);
$paidEnum = new BookingStatusEnum(BookingStatusEnum::PAID);
$failedEnum = new BookingStatusEnum(BookingStatusEnum::FAILED);
$refundedEnum = new BookingStatusEnum(BookingStatusEnum::REFUNDED);

$service = new BookingUpdateStatus(BookingStateFactory::make($pendingEnum), $entity);
$service->updateBookingEntityState();
var_dump($entity);
$service->showCurrentStateInfo();

if (isYourDay()) {
    $entity->hasTransaction = true;
}

$service->transitionTo(BookingStateFactory::make($paidEnum));
$service->updateBookingEntityState();
var_dump($entity);
$service->showCurrentStateInfo();

$service->transitionTo(BookingStateFactory::make($refundedEnum));
$service->updateBookingEntityState();
var_dump($entity);
$service->showCurrentStateInfo();
