<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Primitives\Scalar;

use Smpl\Typing\Concerns\IsCompositeType;
use Smpl\Typing\Concerns\IsPrimitiveType;
use Smpl\Typing\Contracts\CompositeType;
use function Smpl\Typing\type_of;

final class BoolType implements CompositeType
{
    use IsCompositeType, IsPrimitiveType {
        IsCompositeType::isAssignableFrom insteadof IsPrimitiveType;
        IsCompositeType::isAssignableTo insteadof IsPrimitiveType;
    }

    public function __construct()
    {
        /** @infection-ignore-all  */
        $this->setChildTypes([
            type_of('true'),
            type_of('false'),
        ]);
    }

    public function getName(): string
    {
        return 'bool';
    }

    public function isScalar(): bool
    {
        return true;
    }

    public function isOfType(mixed $value): bool
    {
        return is_bool($value);
    }
}