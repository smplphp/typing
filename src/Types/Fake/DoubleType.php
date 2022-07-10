<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Fake;

use Smpl\Typing\Concerns\IsAliasType;
use Smpl\Typing\Concerns\IsPrimitiveType;
use Smpl\Typing\Contracts\ChildType;
use function Smpl\Typing\type_of;

final class DoubleType implements ChildType
{
    use IsPrimitiveType, IsAliasType {
        IsAliasType::isAssignableFrom insteadof IsPrimitiveType;
        IsAliasType::isAssignableTo insteadof IsPrimitiveType;
    }

    public function __construct()
    {
        $this->setParentType(type_of('float'));
    }

    public function getName(): string
    {
        return 'double';
    }

    public function isScalar(): bool
    {
        return true;
    }
}