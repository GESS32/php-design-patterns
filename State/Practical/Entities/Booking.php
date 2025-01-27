<?php

declare(strict_types=1);

namespace State\Practical\Entities;

use DateInterval;
use DateTime;
use InvalidArgumentException;
use State\Practical\Interfaces\BookingStateInterface;
use State\Practical\Interfaces\TenantNotifierInterface;
use State\Practical\States\NewcomerState;

class Booking
{
    private BookingStateInterface $state;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(
        private readonly string $uuid,
        private readonly string $tenantUuid,
        private DateInterval $duration,
        private DateTime $startAt,
        private readonly TenantNotifierInterface $notifier,
        ?BookingStateInterface $state = null
    ) {
        $state ??= new NewcomerState($this);

        if ($state instanceof NewcomerState && $this->validateStartTime($this->startAt)) {
            throw new InvalidArgumentException('DateTime $startAt must be in the future');
        }

        if ($this->validateDuration($this->duration)) {
            throw new InvalidArgumentException('DateInterval $duration must be at least 1 hour');
        }

        $this->transitionTo($state);
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getTenantUuid(): string
    {
        return $this->tenantUuid;
    }

    public function getDuration(): DateInterval
    {
        return clone $this->duration;
    }

    public function getStartAt(): DateTime
    {
        return clone $this->startAt;
    }

    public function getNotifier(): TenantNotifierInterface
    {
        return $this->notifier;
    }

    public function transitionTo(BookingStateInterface $state): void
    {
        $this->state = $state;
    }

    public function showStateInformation(): void
    {
        $this->state->provideInformation();
    }

    public function remindTenant(): void
    {
        $this->state->sendReminder();
    }

    public function changeTime(DateTime $startAt, DateInterval $duration): void
    {
        if ($this->validateStartTime($startAt)) {
            throw new InvalidArgumentException('DateTime $startAt must be in the future');
        }

        if ($this->validateDuration($duration)) {
            throw new InvalidArgumentException('DateInterval $duration must be at least 1 hour');
        }

        $this->startAt = $startAt;
        $this->duration = $duration;

        $this->state->reschedule();
    }

    public function override(string $reason): void
    {
        $this->state->cancel($reason);
        $this->state->suggestReview();
    }

    public function release(): void
    {
        $this->state->complete();
        $this->state->suggestReview();
    }

    private function validateStartTime(DateTime $dateTime): bool
    {
        $now = new DateTime(timezone: $dateTime->getTimezone());
        return $now->getTimestamp() > $dateTime->getTimestamp();
    }

    private function validateDuration(DateInterval $duration): bool
    {
        return $duration->h < 1 && $duration->d < 1;
    }
}
