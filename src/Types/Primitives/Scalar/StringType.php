<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Primitives\Scalar;

use Smpl\Typing\Concerns\IsPrimitiveType;
use Smpl\Typing\Contracts\ClassType;
use Smpl\Typing\Contracts\Type;
use Stringable;
use function Smpl\Typing\type_of_or_return;

final class StringType implements Type
{
    use IsPrimitiveType {
        IsPrimitiveType::isAssignableFrom as isPrimitiveAssignableFrom;
    }

    public function getName(): string
    {
        return 'string';
    }

    public function isScalar(): bool
    {
        return true;
    }

    public function isAssignableFrom(string|Type $type): bool
    {
        $type = type_of_or_return($type);

        if ($type instanceof ClassType && $type->isSubclassOf(Stringable::class)) {
            return true;
        }

        return $this->isPrimitiveAssignableFrom($type);
    }

    public function isOfType(mixed $value): bool
    {
        return is_string($value) || $value instanceof Stringable;
    }
}