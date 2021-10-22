<?php

declare(strict_types=1);

namespace State\Enums;

use LogicException;
use ReflectionClass;
use State\Interfaces\StateEnum;
use State\States\BookingFailed;
use State\States\BookingPaid;
use State\States\BookingPending;
use State\States\BookingRefund;
use State\States\BookingRefundPending;

class BookingStatusEnum implements StateEnum
{
    private int $value;

    public const PENDING = 1;
    public const PAID = 2;
    public const FAILED = 3;
    public const REFUND_PENDING = 4;
    public const REFUNDED = 5;

    private static array $valuesStates = [
        self::PENDING => BookingPending::class,
        self::PAID => BookingPaid::class,
        self::FAILED => BookingFailed::class,
        self::REFUND_PENDING => BookingRefundPending::class,
        self::REFUNDED => BookingRefund::class,
    ];

    public function __construct(int $value)
    {
        $selfReflection = new ReflectionClass($this);

        if (in_array($value, $selfReflection->getConstants())) {
            $this->value = $value;
        } else {
            throw new LogicException('The "' . $value . ' does not exist in ' . self::class);
        }
    }

    public function is(int $value): bool
    {
        return $this->value == $value;
    }

    public function isNot(int $value): bool
    {
        return !$this->is($value);
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getStateClass(): string
    {
        return self::$valuesStates[$this->value] ?? '';
    }
}