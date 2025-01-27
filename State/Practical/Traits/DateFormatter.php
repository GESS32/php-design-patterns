<?php

declare(strict_types=1);

namespace State\Practical\Traits;

use DateInterval;
use DateTime;

trait DateFormatter
{
    protected function humanDateTime(DateTime $dateTime): string
    {
        return $dateTime->format('Y-m-d H:i:s');
    }

    protected function humanInterval(DateInterval $interval): string
    {
        $parts = [];

        if ($interval->y) {
            $parts[] = $interval->y . ' year' . ($interval->y > 1 ? 's' : '');
        }

        if ($interval->m) {
            $parts[] = $interval->m . ' month' . ($interval->m > 1 ? 's' : '');
        }

        if ($interval->d) {
            $parts[] = $interval->d . ' day' . ($interval->d > 1 ? 's' : '');
        }

        if ($interval->h) {
            $parts[] = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '');
        }

        if ($interval->i) {
            $parts[] = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '');
        }

        if ($interval->s) {
            $parts[] = $interval->s . ' second' . ($interval->s > 1 ? 's' : '');
        }

        return implode(', ', $parts);
    }
}
