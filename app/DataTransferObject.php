<?php

declare(strict_types=1);

namespace app;

use ReflectionClass;
use ReflectionProperty;

abstract class DataTransferObject
{
    public function __construct(array $parameters = [])
    {
        $class = new ReflectionClass(static::class);

        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $reflectionProperty) {
            $property = $reflectionProperty->getName();

            if (isset($parameters[$property])) {
                $this->{$property} = $parameters[$property];
            }
        }
    }
}