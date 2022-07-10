<?php

declare(strict_types=1);

namespace Smpl\Typing\Exceptions;

use Exception;

final class TypingException extends Exception
{
    public static function invalidClass(string $class): self
    {
        return new self(sprintf(
            'Provided type \'%s\' is not a valid class',
            $class
        ));
    }

    public static function noMapping(string $typeName): self
    {
        return new self(sprintf(
            'There is no mapping for the provided type \'%s\'',
            $typeName
        ));
    }

    public static function invalidMultiType(string $typeName): self
    {
        return new self(sprintf(
            'Types cannot mixed the nullable, union and intersection operators \'%s\'',
            $typeName
        ));
    }

    public static function compoundNull(): self
    {
        return new self(
            'The type \'null\' cannot be compounded to be nullable'
        );
    }

    public static function invalidUnionType(string $typeName): self
    {
        return new self(sprintf(
            'The provided type \'%s\', is not a valid union type',
            $typeName
        ));
    }

    public static function invalidIntersectionType(string $typeName): self
    {
        return new self(sprintf(
            'The provided type \'%s\', is not a valid intersection type',
            $typeName
        ));
    }
}