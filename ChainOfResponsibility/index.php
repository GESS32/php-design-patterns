<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use ChainOfResponsibility\Entities\UserEntity;
use ChainOfResponsibility\Facades\ToViewModelFacade;
use ChainOfResponsibility\ViewModels\UserViewModel;

function showResult(?UserViewModel $viewModel, $data)
{
    echo 'input data: <br>';
    var_dump($data);
    echo '<br>';
    if (is_null($viewModel)) {
        echo '<< Has not result >><br>';
    } else {
        echo 'Full name: ' . $viewModel->getFullName() . '<br>';
        echo 'Email: ' . $viewModel->getEmail() . '<br>';
        echo 'Age: ' . $viewModel->getAge() . '<br>';
    }

    echo '<br>';
}

$stringData = 'some string';
$intData = 1;
$userEntity = UserEntity::find(1);

$arrayData = [
    'fullName' => 'Heinrich Gess',
    'email' => 'gess32@gmail.com',
    'age' => 15,
];

$objectData = (object) [
    'fullName' => 'Nate Diaz',
    'email' => 'nate209@gmail.com',
    'age' => 209,
];

$viewModel = new UserViewModel(
    'Nick Diaz',
    'nick209@gmail.com',
    209
);

$facade = new ToViewModelFacade();

showResult($facade->handle($userEntity), $userEntity);
showResult($facade->handle($intData), $intData);
showResult($facade->handle($arrayData), $arrayData);
showResult($facade->handle($objectData), $objectData);
showResult($facade->handle($stringData), $stringData);
showResult($facade->handle($viewModel), $viewModel);