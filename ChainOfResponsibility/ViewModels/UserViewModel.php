<?php

declare(strict_types=1);

namespace ChainOfResponsibility\ViewModels;

class UserViewModel
{
    protected string $fullName;
    protected string $email;
    protected int $age;

    public function __construct(string $fullName, string $email, int $age)
    {
        $this->fullName = $fullName;
        $this->email = $email;
        $this->age = $age;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAge(): int
    {
        return $this->age;
    }
}