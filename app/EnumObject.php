<?php

declare(strict_types=1);

namespace app;

use LogicException;
use ReflectionClass;

abstract class EnumObject
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param mixed $value
     * @throws LogicException
     */
    public function __construct($value)
    {
        $staticReflection = new ReflectionClass($this);

        if (in_array($value, $staticReflection->getConstants())) {
            $this->value = $value;
        } else {
            throw new LogicException('The "' . $value . ' does not exists in the ' . static::class);
        }
    }

    public function is($value): bool
    {
        return $this->value === $value;
    }

    public function isNot($value): bool
    {
        return $this->value !== $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}