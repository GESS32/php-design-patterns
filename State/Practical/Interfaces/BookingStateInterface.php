<?php

declare(strict_types=1);

namespace State\Practical\Interfaces;

interface BookingStateInterface
{
    public function sendReminder(): void;

    public function suggestReview(): void;

    public function provideInformation(): void;

    public function cancel(string $reason): void;

    public function complete(): void;

    public function reschedule(): void;
}
