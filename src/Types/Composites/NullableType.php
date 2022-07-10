<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Composites;

use Smpl\Typing\Concerns\ProxiesToChildren;
use Smpl\Typing\Contracts\CompositeType;
use Smpl\Typing\Contracts\Type;
use Smpl\Typing\Support\TypeHelper;
use function Smpl\Typing\type_of;

class NullableType implements CompositeType
{
    use ProxiesToChildren;

    public function __construct(Type $childType)
    {
        $this->setChildTypes([
            type_of('null'),
            $childType,
        ]);
    }

    public function getName(): string
    {
        return implode(
            TypeHelper::UNION_SEPARATOR,
            $this->getChildTypes()
        );
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public function isNullable(): bool
    {
        return true;
    }
}