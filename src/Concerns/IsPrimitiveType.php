<?php

declare(strict_types=1);

namespace Smpl\Typing\Concerns;

use Smpl\Typing\Contracts\Type;
use function Smpl\Typing\type_of_or_return;

trait IsPrimitiveType
{
    public function __toString()
    {
        return $this->getName();
    }

    public function isNative(): bool
    {
        return true;
    }

    public function isNullable(): bool
    {
        return false;
    }

    public function isPrimitive(): bool
    {
        return true;
    }

    public function isScalar(): bool
    {
        return false;
    }

    public function isCompound(): bool
    {
        return false;
    }

    public function isSpecial(): bool
    {
        return false;
    }

    public function isBuiltin(): bool
    {
        return true;
    }

    public function isInternal(): bool
    {
        return false;
    }

    public function isUserDefined(): bool
    {
        return false;
    }

    public function isParameterType(): bool
    {
        return true;
    }

    public function isPropertyType(): bool
    {
        return true;
    }

    public function isReturnType(): bool
    {
        return true;
    }

    public function isStandaloneType(): bool
    {
        return true;
    }

    public function isNativeStandaloneType(): bool
    {
        return true;
    }

    public function isAssignableFrom(string|Type $type): bool
    {
        return type_of_or_return($type)->getName() === $this->getName();
    }

    public function isAssignableTo(string|Type $type): bool
    {
        return type_of_or_return($type)->getName() === $this->getName();
    }
}