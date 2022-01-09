<?php

declare(strict_types=1);

namespace app;

use ReflectionClass;
use ReflectionProperty;

class Response extends DataTransferObject
{
    protected $status = null;
    protected ?string $message = null;

    public function dump(): void
    {
        $dumpData = [];
        $class = new ReflectionClass(static::class);

        foreach ($class->getProperties(ReflectionProperty::IS_PROTECTED) as $reflectionProperty) {
            $propertyName = $reflectionProperty->getName();
            $dumpData[$propertyName] = $this->{$propertyName};
        }

        var_dump($dumpData);
    }
}