<?php

declare(strict_types=1);

namespace ChainOfResponsibility\Chains;

use ChainOfResponsibility\ViewModels\UserViewModel;

class ObjectToViewModel extends DataToViewModel
{
    public function handle($data): ?UserViewModel
    {
        if (is_object($data)) {
            $data = (array) $data;

            $this->setNext(new ArrayToViewModel());
        }

        return parent::handle($data);
    }
}