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
}