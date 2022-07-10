<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Primitives\Scalar;

use Smpl\Typing\Concerns\IsPrimitiveType;
use Smpl\Typing\Contracts\Type;

final class IntType implements Type
{
    use IsPrimitiveType;

    public function getName(): string
    {
        return 'int';
    }

    public function isScalar(): bool
    {
        return true;
    }

    public function isOfType(mixed $value): bool
    {
        return is_int($value);
    }
}