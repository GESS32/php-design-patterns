<?php

declare(strict_types=1);

namespace State\Entities;

final class BookingEntity
{
    public int $status;
    public bool $hasTransaction = false;
}