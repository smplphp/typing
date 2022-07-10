<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Primitives\Scalar;

use Smpl\Typing\Concerns\IsPrimitiveType;
use Smpl\Typing\Contracts\Type;

final class FloatType implements Type
{
    use IsPrimitiveType;

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
}