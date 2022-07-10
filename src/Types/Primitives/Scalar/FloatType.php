<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Primitives\Scalar;

use Smpl\Typing\Concerns\IsPrimitiveType;
use Smpl\Typing\Contracts\ChildType;
use Smpl\Typing\Contracts\Type;
use function Smpl\Typing\type_of;
use function Smpl\Typing\type_of_or_return;

final class FloatType implements Type
{
    use IsPrimitiveType {
        IsPrimitiveType::isAssignableTo as isPrimitiveAssignableTo;
        IsPrimitiveType::isAssignableFrom as isPrimitiveAssignableFrom;
    }

    public function getName(): string
    {
        return 'float';
    }

    public function isScalar(): bool
    {
        return true;
    }

    public function isOfType(mixed $value): bool
    {
        return is_float($value);
    }

    public function isAssignableFrom(string|Type $type): bool
    {
        $type = type_of_or_return($type);

        if ($type instanceof ChildType) {
            return $type->getParentType()->getName() === $this->getName();
        }

        return $this->isPrimitiveAssignableFrom($type);
    }

    public function isAssignableTo(string|Type $type): bool
    {
        $type = type_of_or_return($type);

        if ($type instanceof ChildType) {
            return $type->getParentType()->getName() === $this->getName();
        }

        return $this->isPrimitiveAssignableTo($type);
    }
}