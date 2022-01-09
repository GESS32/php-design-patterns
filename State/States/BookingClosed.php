<?php

declare(strict_types=1);

namespace State\States;

use app\Response;
use State\Enums\BookingStatusEnum;

class BookingClosed extends AbstractBookingState
{
    public function rollbackStatus(): Response
    {
        $pendingState = new BookingPendingForPayment($this->context);

        $this->context->transitionStateTo($pendingState);

        // TODO: Implement rollbackStatus() method.
    }

    public function prepareRefundRequest(): Response
    {
        // TODO: Implement prepareRefundRequest() method.
    }

    public function preparePayRequest(): Response
    {
        $this->rollbackStatus();

        return $this->context->getPayRoute();
    }

    protected function getStatusValue(): int
    {
        return BookingStatusEnum::CLOSED;
    }
}