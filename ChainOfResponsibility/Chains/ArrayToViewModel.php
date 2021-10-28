<?php

declare(strict_types=1);

namespace ChainOfResponsibility\Chains;

use ChainOfResponsibility\ViewModels\UserViewModel;

class ArrayToViewModel extends DataToViewModel
{
    public function handle($data): ?UserViewModel
    {
        if (is_array($data)) {
            return new UserViewModel(
                $data['fullName'],
                $data['email'],
                $data['age']
            );
        }

        return parent::handle($data);
    }
}