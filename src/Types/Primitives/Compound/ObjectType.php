<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Primitives\Compound;

use Smpl\Typing\Concerns\IsPrimitiveType;
use Smpl\Typing\Contracts\ClassType;
use Smpl\Typing\Contracts\Type;
use function Smpl\Typing\type_of_or_return;

final class ObjectType implements Type
{
    use IsPrimitiveType;

    public function getName(): string
    {
        return 'object';
    }

    public function isOfType(mixed $value): bool
    {
        return is_object($value);
    }

    public function isCompound(): bool
    {
        return true;
    }

    public function isAssignableFrom(string|Type $type): bool
    {
        $type = type_of_or_return($type);

        return $type->getName() === 'object' || $type instanceof ClassType;
    }
}