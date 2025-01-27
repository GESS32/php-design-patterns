<?php

declare(strict_types=1);

namespace State\Practical\Interfaces;

interface TenantNotifierInterface
{
    public function send(string $uuid, string $subject, string $message): void;
}
