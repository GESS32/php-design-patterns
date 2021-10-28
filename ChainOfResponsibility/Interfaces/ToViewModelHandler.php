<?php

declare(strict_types=1);

namespace ChainOfResponsibility\Interfaces;

use ChainOfResponsibility\ViewModels\UserViewModel;

interface ToViewModelHandler
{
    public function setNext(ToViewModelHandler $next): void;

    public function handle($data): ?UserViewModel;
}