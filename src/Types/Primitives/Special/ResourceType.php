<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Primitives\Special;

use Smpl\Typing\Concerns\IsPrimitiveType;
use Smpl\Typing\Contracts\ChildType;
use Smpl\Typing\Contracts\Type;
use function Smpl\Typing\type_of_or_return;

final class ResourceType implements Type
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
        return 'resource';
    }

    public function isSpecial(): bool
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

    public function isOfType(mixed $value): bool
    {
        return is_resource($value);
    }
}