<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Primitives\Special;

use Smpl\Typing\Concerns\IsPrimitiveType;
use Smpl\Typing\Contracts\Type;
use function Smpl\Typing\type_of_or_return;

final class NullType implements Type
{
    use IsPrimitiveType {
        IsPrimitiveType::isAssignableTo as isPrimitiveAssignableTo;
        IsPrimitiveType::isAssignableFrom as isPrimitiveAssignableFrom;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getName(): string
    {
        return 'null';
    }

    public function isNullable(): bool
    {
        return true;
    }

    public function isSpecial(): bool
    {
        return true;
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
        return false;
    }

    public function isNativeStandaloneType(): bool
    {
        return false;
    }

    public function isAssignableFrom(string|Type $type): bool
    {
        $type = type_of_or_return($type);

        return $type->getName() === 'null';
    }

    public function isAssignableTo(string|Type $type): bool
    {
        $type = type_of_or_return($type);

        return $type->isNullable();
    }

    public function isOfType(mixed $value): bool
    {
        return $value === null;
    }
}