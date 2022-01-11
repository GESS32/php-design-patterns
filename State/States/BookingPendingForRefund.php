<?php

declare(strict_types=1);

namespace State\States;

use app\Response;
use State\Enums\BookingStatusEnum;

final class BookingPendingForRefund extends AbstractBookingState
{
    public function previousState(): Response
    {
        $pendingState = new BookingPaid($this->context);

        $this->context->transitionStateTo($pendingState);

        // TODO: Implement rollbackStatus() method.
    }

    public function prepareRefundRequest(): Response
    {
        // TODO: Implement prepareRefundRequest() method.
    }

    public function preparePayRequest(): Response
    {
        // TODO: Implement preparePayRequest() method.
    }

    protected function getStatusValue(): int
    {
        return BookingStatusEnum::REFUND_PENDING;
    }
}