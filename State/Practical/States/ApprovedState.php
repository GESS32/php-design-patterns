<?php

declare(strict_types=1);

namespace State\Practical\States;

use State\Practical\Entities\Booking;
use State\Practical\Interfaces\BookingStateInterface;
use State\Practical\Traits\DateFormatter;

readonly class ApprovedState implements BookingStateInterface
{
    use DateFormatter;

    public function __construct(private Booking $context) {}

    public function sendReminder(): void
    {
        $message = 'This is a friendly reminder about your upcoming booking with us.';
        $message .= "\nBooking Item: {$this->context->getUuid()}";
        $message .= "\nStart at: {$this->humanDateTime($this->context->getStartAt())}";
        $message .= "\nDuration: {$this->humanInterval($this->context->getDuration())}";
        $message .= "\nIf you need to make any changes or have any questions, feel free to contact us.";

        $this->context->getNotifier()->send($this->context->getTenantUuid(), 'Reminder', $message);
    }

    public function suggestReview(): void
    {
        $message = 'We’d appreciate it if you could share your thoughts on the approval speed.';
        $message .= "\nYour feedback helps us improve our service and ensure we meet your expectations.";

        $this->context->getNotifier()->send($this->context->getTenantUuid(), 'Review', $message);
    }

    public function provideInformation(): void
    {
        $message = 'Your booking request has been approved.';
        $message .= "\nBooking Item: {$this->context->getUuid()}";
        $message .= "\nStart at: {$this->humanDateTime($this->context->getStartAt())}";
        $message .= "\nDuration: {$this->humanInterval($this->context->getDuration())}";
        $message .= "\nThank you for choosing our company!";

        $this->context->getNotifier()->send($this->context->getTenantUuid(), 'Information', $message);
    }

    public function cancel(string $reason): void
    {
        $this->context->getNotifier()->send(
            $this->context->getTenantUuid(),
            'Cancellation',
            "Your booking \"{$this->context->getUuid()}\" has been cancelled.\nReason: $reason"
        );

        $this->context->transitionTo(new ClosedState($this->context));
    }

    public function complete(): void
    {
        $message = 'Your booking has been completed. We hope you had a great experience with us!';

        $this->context->getNotifier()->send($this->context->getTenantUuid(), 'Complete', $message);
        $this->context->transitionTo(new ClosedState($this->context));
    }

    public function reschedule(): void
    {
        $nextState = new NewcomerState($this->context);

        $this->context->transitionTo($nextState);
        $nextState->reschedule();
    }
}
