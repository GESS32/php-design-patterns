<?php

declare(strict_types=1);

namespace ChainOfResponsibility\Facades;

use ChainOfResponsibility\Chains\ArrayToViewModel;
use ChainOfResponsibility\Chains\EntityToViewModel;
use ChainOfResponsibility\Chains\isViewModel;
use ChainOfResponsibility\Chains\ObjectToViewModel;
use ChainOfResponsibility\Interfaces\ToViewModelHandler;
use ChainOfResponsibility\ViewModels\UserViewModel;

class ToViewModelFacade
{
    protected ToViewModelHandler $handler;

    protected array $chainMap = [
        isViewModel::class => EntityToViewModel::class,
        EntityToViewModel::class => ObjectToViewModel::class,
        ObjectToViewModel::class => ArrayToViewModel::class,
    ];

    public function __construct()
    {
        $handlerClass = array_key_first($this->chainMap);
        $this->handler = $this->buildChain(new $handlerClass());
    }

    public function handle($data): ?UserViewModel
    {
        return $this->handler->handle($data);
    }

    protected function buildChain(ToViewModelHandler $handler): ToViewModelHandler
    {
        $nextClass = $this->chainMap[get_class($handler)] ?? null;

        if (!empty($nextClass) && class_exists($nextClass)) {
            $nextHandler = new $nextClass();

            $handler->setNext($this->buildChain($nextHandler));
        }

        return $handler;
    }
}