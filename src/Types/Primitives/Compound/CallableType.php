<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Primitives\Compound;

use Smpl\Typing\Concerns\IsPrimitiveType;
use Smpl\Typing\Contracts\ChildType;
use Smpl\Typing\Contracts\ClassType;
use Smpl\Typing\Contracts\Type;
use function Smpl\Typing\type_of_or_return;

final class CallableType implements Type
{
    use IsPrimitiveType;

    public function getName(): string
    {
        return 'callable';
    }

    public function isOfType(mixed $value): bool
    {
        return is_callable($value);
    }

    public function isParameterType(): bool
    {
        return true;
    }

    public function isPropertyType(): bool
    {
        return false;
    }

    public function isReturnType(): bool
    {
        return false;
    }

    public function isCompound(): bool
    {
        return true;
    }

    public function isAssignableFrom(string|Type $type): bool
    {
        $type = type_of_or_return($type);

        if ($type->getName() === $this->getName()) {
            return true;
        }

        /** @infection-ignore-all  */
        if ($type instanceof ChildType && $type->getParentType()->getName() === $this->getName()) {
            return true;
        }

        /** @infection-ignore-all  */
        if ($type instanceof ClassType) {
            return is_callable($type->getName()) || method_exists($type->getName(), '__invoke');
        }

        return false;
    }
}