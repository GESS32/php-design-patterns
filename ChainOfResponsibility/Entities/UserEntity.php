<?php

declare(strict_types=1);

namespace ChainOfResponsibility\Entities;

class UserEntity
{
    public int $id;
    public string $email;
    public string $fullName;
    public int $age;

    public static function find(int $id): UserEntity
    {
        $user = new UserEntity();

        $user->id = $id;
        $user->email = 'uncle@webspark.com';
        $user->fullName = 'Stas G';
        $user->age = 50;

        return $user;
    }
}