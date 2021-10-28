<?php

declare(strict_types=1);

namespace ChainOfResponsibility\Chains;

use ChainOfResponsibility\ViewModels\UserViewModel;

class isViewModel extends DataToViewModel
{
    public function handle($data): ?UserViewModel
    {
        if ($data instanceof UserViewModel) {
            return $data;
        }

        return parent::handle($data);
    }
}