<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Fake;

use Smpl\Typing\Concerns\IsPrimitiveType;
use Smpl\Typing\Contracts\Type;
use function Smpl\Typing\type_of_or_return;

final class TrueType implements Type
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
        return 'true';
    }

    public function isNative(): bool
    {
        return false;
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
        return true;
    }

    public function isNativeStandaloneType(): bool
    {
        return false;
    }

    public function isAssignableFrom(string|Type $type): bool
    {
        $type = type_of_or_return($type);

        return $this->isPrimitiveAssignableFrom($type) || $type->getName() === 'bool';
    }

    public function isAssignableTo(string|Type $type): bool
    {
        $type = type_of_or_return($type);

        return $this->isPrimitiveAssignableTo($type) || $type->getName() === 'bool';
    }

    public function isOfType(mixed $value): bool
    {
        return $value === true;
    }
}