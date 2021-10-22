<?php

declare(strict_types=1);

namespace State\States;

use State\Entities\BookingEntity;
use State\Interfaces\BookingStateContext;

abstract class AbstractBookingState
{
    protected BookingStateContext $context;
    protected string $operationLog = '';

    abstract public function updateEntity(BookingEntity $entity): void;

    protected function addOperationLog(string $message): void
    {
        $this->operationLog .= "\n" . $message;
    }

    public function showLog(): void
    {
        echo $this->operationLog;
    }

    public function setContext(BookingStateContext $context): void
    {
        $this->context = $context;
    }
}