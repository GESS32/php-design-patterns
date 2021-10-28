<?php

declare(strict_types=1);

namespace ChainOfResponsibility\Chains;

use ChainOfResponsibility\Interfaces\ToViewModelHandler;
use ChainOfResponsibility\ViewModels\UserViewModel;

abstract class DataToViewModel implements ToViewModelHandler
{
    protected ToViewModelHandler $next;

    public function setNext(ToViewModelHandler $next): void
    {
        $this->next = $next;
    }

    public function handle($data): ?UserViewModel
    {
        if (empty($this->next)) {
            return null;
        }

        return $this->next->handle($data);
    }
}