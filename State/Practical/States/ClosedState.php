<?php

declare(strict_types=1);

namespace State\Practical\States;

use State\Practical\Entities\Booking;
use State\Practical\Interfaces\BookingStateInterface;

readonly class ClosedState implements BookingStateInterface
{
    public function __construct(private Booking $context) {}

    public function sendReminder(): void
    {
        // already closed
    }

    public function suggestReview(): void
    {
        $message = 'We hope you had a great experience with our service!';
        $message .= "\nWe’d love to hear your thoughts and any feedback you may have about your overall experience.";

        $this->context->getNotifier()->send($this->context->getTenantUuid(), 'Review', $message);
    }

    public function provideInformation(): void
    {
        $this->context->getNotifier()->send(
            $this->context->getTenantUuid(),
            'Information',
            "Your booking request \"{$this->context->getUuid()}\" has been closed."
        );
    }

    public function cancel(string $reason): void
    {
        // already closed
    }

    public function complete(): void
    {
        // already closed
    }

    public function reschedule(): void
    {
        // already closed
    }
}
