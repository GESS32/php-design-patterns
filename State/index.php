<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use State\Entities\Booking;
use State\EnumObjects\BookingStatus;
use State\Enums\BookingStatusEnum;
use State\Factories\BookingStateFactory;
use State\Mappings\BookingStatusStateMapping;
use State\Services\BookingService;

/**
 * Some conditional event...
 */
function isYourDay(): bool
{
    return (bool) random_int(0, 1);
}

$entity = new Booking();
$stateMapping = new BookingStatusStateMapping();

$pendingStatus = new BookingStatus(BookingStatusEnum::PAYMENT_PENDING);
$paidStatus = new BookingStatus(BookingStatusEnum::PAID);
$failedStatus = new BookingStatus(BookingStatusEnum::FAILED);
$refundedStatus = new BookingStatus(BookingStatusEnum::REFUNDED);

$service = new BookingUpdateStatus(BookingStateFactory::make($pendingStatus, $stateMapping), $entity);
$service->updateBookingEntityState();
var_dump($entity);
$service->showCurrentStateInfo();

if (isYourDay()) {
    $entity->hasTransaction = true;
}

$service->transitionStateTo(BookingStateFactory::make($paidStatus));
$service->updateBookingEntityState();
var_dump($entity);
$service->showCurrentStateInfo();

$service->transitionStateTo(BookingStateFactory::make($refundedStatus));
$service->updateBookingEntityState();
var_dump($entity);
$service->showCurrentStateInfo();
