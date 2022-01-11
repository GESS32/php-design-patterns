<?php

declare(strict_types=1);

namespace State\States;

use app\Response;
use State\Enums\BookingStatusEnum;

final class BookingFailed extends AbstractBookingState
{
    public function previousState(): Response
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
        $this->previousState();

        return $this->context->getPayRoute();
    }

    protected function getStatusValue(): int
    {
        return BookingStatusEnum::FAILED;
    }
}