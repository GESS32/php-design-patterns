<?php

declare(strict_types=1);

namespace State\Interfaces;

interface BookingEntity
{
    public function setCustomerName(string $name): void;

    public function setCustomerPhone(string $phone): void;

    public function setStatus(int $status): void;

    public function setAmount(?float $amount): void;

    public function setCreatedAt(string $dateTime): void;

    public function setUpdatedAt(string $dateTime): void;

    public function setRefundApprovedAt(?string $dateTime): void;

    public function getCustomerName(): string;

    public function getCustomerPhone(): string;

    public function getStatus(): int;

    public function getAmount(): ?float;

    public function getCreatedAt(): string;

    public function getUpdatedAt(): string;

    public function getRefundApprovedAt(): ?string;

}