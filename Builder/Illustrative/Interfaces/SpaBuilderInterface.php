<?php

declare(strict_types=1);

namespace App\Builder\Illustrative\Interfaces;

interface SpaBuilderInterface
{
    /**
     * Методы строителя могут возвращать сам строитель после своего выполнения, но это *не обязательно*.
     */
    public function setPool(PoolInterface $entity): static;

    public function setSauna(SaunaInterface $entity): static;

    public function setSeats(int $quantity): static;

    /**
     * Метод для получения результата строительства спа.
     * Строитель не должен возвращать интерфейс конкретного продукта, но и не исключает такой возможности.
     */
    public function getResult(): mixed;

    public function reset(): static;
}
