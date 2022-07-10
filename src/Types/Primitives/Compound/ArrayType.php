<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Primitives\Compound;

use Smpl\Typing\Concerns\IsChildType;
use Smpl\Typing\Concerns\IsPrimitiveType;
use Smpl\Typing\Contracts\ChildType;
use Smpl\Typing\Contracts\Type;
use function Smpl\Typing\type_of;
use function Smpl\Typing\type_of_or_return;

final class ArrayType implements ChildType
{
    use IsPrimitiveType, IsChildType {
        IsPrimitiveType::isAssignableTo as isPrimitiveAssignableTo;
        IsChildType::isAssignableTo as isParentAssignableTo;
        IsPrimitiveType::isAssignableFrom insteadof IsChildType;
    }

    public function __construct()
    {
        /** @infection-ignore-all  */
        $this->setParentType(type_of('iterable'));
    }

    public function getName(): string
    {
        return 'array';
    }

    public function isAssignableTo(string|Type $type): bool
    {
        $type = type_of_or_return($type);

        return $this->isPrimitiveAssignableTo($type)
            || $this->isParentAssignableTo($type);
    }

    public function isOfType(mixed $value): bool
    {
        return is_array($value);
    }

    public function isCompound(): bool
    {
        return true;
    }

    public function isAlias(): bool
    {
        return false;
    }
}