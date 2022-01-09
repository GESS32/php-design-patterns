<?php

declare(strict_types=1);

namespace State\Dto;

use app\DataTransferObject;

class BookingDto extends DataTransferObject
{
    public string $customerName;
    public string $customerPhone;
    public int $status;
    public ?float $amount = null;
    public string $createdAt;
    public string $updatedAt;
    public ?string $refundApprovedAt = null;
}