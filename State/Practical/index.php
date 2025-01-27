<?php

declare(strict_types=1);

use State\Practical\Entities\Booking;
use State\Practical\Services\TenantEchoNotifier;
use State\Practical\States\ApprovedState;

require_once '../../vendor/autoload.php';

function tenantCreates(string $id): Booking
{
    echo 'Tenant creates a booking.';

    $booking = new Booking(
        uuid: $id,
        tenantUuid: 'a-example-user',
        duration: DateInterval::createFromDateString('1 day'),
        startAt: new DateTime('tomorrow 10:00'),
        notifier: new TenantEchoNotifier()
    );

    $booking->showStateInformation();

    return $booking;
}

function administratorApproves(Booking $booking): void
{
    echo 'Administrator approves the booking.';
    $booking->transitionTo(new ApprovedState($booking));
    $booking->showStateInformation();
}

function tenantCancels(Booking $booking): void
{
    echo 'Tenant cancels the booking.';
    $booking->override('I change my plans');
    $booking->showStateInformation();
}

function tenantChangesTime(Booking $booking): void
{
    echo 'Tenant changes the booking time.';

    $booking->changeTime(
        startAt: new DateTime('+7 days 15:30'),
        duration: DateInterval::createFromDateString('1 day')
    );

    $booking->showStateInformation();
}

function cronAutoReminds(Booking $booking): void
{
    echo 'Cron job sends reminders.';
    $booking->remindTenant();
}

function cronAutoReleases(Booking $booking): void
{
    echo 'Cron job auto releases bookings.';
    $booking->release();
}

echo PHP_EOL, 'First scenario:', PHP_EOL;

$booking = tenantCreates('BOOKING-ONE');

administratorApproves($booking);
tenantCancels($booking);

echo PHP_EOL, 'Second scenario:', PHP_EOL;

$booking = tenantCreates('BOOKING-TWO');

administratorApproves($booking);
cronAutoReminds($booking);
tenantChangesTime($booking);
cronAutoReminds($booking);
administratorApproves($booking);
cronAutoReleases($booking);
