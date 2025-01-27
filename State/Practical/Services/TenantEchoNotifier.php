<?php

declare(strict_types=1);

namespace State\Practical\Services;

use State\Practical\Interfaces\TenantNotifierInterface;

class TenantEchoNotifier implements TenantNotifierInterface
{
    public function send(string $uuid, string $subject, string $message): void
    {
        echo PHP_EOL, '---', PHP_EOL;
        echo 'Subject: ', $subject;
        echo PHP_EOL;
        echo 'Message: ', $message;
        echo PHP_EOL, '---', PHP_EOL;
    }
}
