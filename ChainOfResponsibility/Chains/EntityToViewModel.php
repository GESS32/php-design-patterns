<?php

declare(strict_types=1);

namespace ChainOfResponsibility\Chains;

use ChainOfResponsibility\Entities\UserEntity;
use ChainOfResponsibility\ViewModels\UserViewModel;

class EntityToViewModel extends DataToViewModel
{
    public function handle($data): ?UserViewModel
    {
        if ($data instanceof UserEntity) {
            return new UserViewModel(
                $data->fullName,
                $data->email,
                $data->age
            );
        }

        return parent::handle($data);
    }
}