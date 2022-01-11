<?php

declare(strict_types=1);

namespace State\Entities;

use app\Response;
use State\Interfaces\BookingContext;
use State\Interfaces\BookingState;

final class Booking implements BookingContext
{
    protected string $customerName;
    protected string $customerPhone;
    protected ?float $amount;
    protected string $createdAt;
    protected string $updatedAt;
    protected ?string $refundApprovedAt;

    protected int $status;
    protected BookingState $state;

    public function __construct(BookingState $state)
    {
        $this->transitionStateTo($state);
    }

    public function transitionStateTo(BookingState $state): void
    {
        $this->state = $state;
    }

    public function cancelOperation(): Response
    {
        return $this->state->previousState();
    }

    public function getRefundRoute(): Response
    {
        return $this->state->prepareRefundRequest();
    }

    public function getPayRoute(): Response
    {
        return $this->state->preparePayRequest();
    }

    public function setCustomerName(string $name): void
    {
        $this->customerName = $name;
    }

    public function setCustomerPhone(string $phone): void
    {
        $this->customerPhone = $phone;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function setAmount(?float $amount): void
    {
        $this->amount = $amount;
    }

    public function setCreatedAt(string $dateTime): void
    {
        $this->createdAt = $dateTime;
    }

    public function setUpdatedAt(string $dateTime): void
    {
        $this->updatedAt = $dateTime;
    }

    public function setRefundApprovedAt(?string $dateTime): void
    {
        $this->refundApprovedAt = $dateTime;
    }

    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    public function getCustomerPhone(): string
    {
        return $this->customerPhone;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getRefundApprovedAt(): string
    {
        return $this->refundApprovedAt;
    }
}