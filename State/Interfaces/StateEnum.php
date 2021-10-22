<?php

declare(strict_types=1);

namespace State\Interfaces;

interface StateEnum
{
    public function getStateClass(): string;

    public function getValue(): int;
}