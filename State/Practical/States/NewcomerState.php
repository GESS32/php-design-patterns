<?php

declare(strict_types=1);

namespace State\Practical\States;

use State\Practical\Entities\Booking;
use State\Practical\Interfaces\BookingStateInterface;
use State\Practical\Traits\DateFormatter;

readonly class NewcomerState implements BookingStateInterface
{
    use DateFormatter;

    public function __construct(private Booking $context) {}

    public function sendReminder(): void
    {
        $message = 'This is a friendly reminder about your upcoming booking with us.';
        $message .= "\nBooking Item: {$this->context->getUuid()}";
        $message .= "\nStart at: {$this->humanDateTime($this->context->getStartAt())}";
        $message .= "\nDuration: {$this->humanInterval($this->context->getDuration())}";
        $message .= "\nYour request still needs to be reviewed by our team.";

        $this->context->getNotifier()->send($this->context->getTenantUuid(), 'Reminder', $message);
    }

    public function suggestReview(): void
    {
        // No need to suggest review on a new booking request
    }

    public function provideInformation(): void
    {
        $message = 'We have received your booking request.';
        $message .= "\nBooking Item: {$this->context->getUuid()}";
        $message .= "\nStart at: {$this->humanDateTime($this->context->getStartAt())}";
        $message .= "\nDuration: {$this->humanInterval($this->context->getDuration())}";
        $message .= "\nOur team will review your request and get back to you shortly with a approval.";

        $this->context->getNotifier()->send($this->context->getTenantUuid(), 'Information', $message);
    }

    public function cancel(string $reason): void
    {
        $this->context->transitionTo(new ClosedState($this->context));
    }

    public function complete(): void
    {
        $this->context->transitionTo(new ApprovedState($this->context));
    }

    public function reschedule(): void
    {
        $message = 'Your booking request has been rescheduled.';
        $message .= "\nBooking Item: {$this->context->getUuid()}";
        $message .= "\nStart at: {$this->humanDateTime($this->context->getStartAt())}";
        $message .= "\nDuration: {$this->humanInterval($this->context->getDuration())}";
        $message .= "\nOur team will review your request and get back to you shortly with a approval.";

        $this->context->getNotifier()->send($this->context->getTenantUuid(), 'Reschedule', $message);
    }
}
