<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Composites;

use Smpl\Typing\Concerns\IsCompositeType;
use Smpl\Typing\Concerns\ProxiesToChildren;
use Smpl\Typing\Contracts\CompositeType;
use Smpl\Typing\Support\TypeHelper;

class UnionType implements CompositeType
{
    use IsCompositeType, ProxiesToChildren;

    /**
     * @param list<\Smpl\Typing\Contracts\Type> $subTypes
     */
    public function __construct(array $subTypes)
    {
        $this->setChildTypes($subTypes);
    }

    public function getName(): string
    {
        return implode(TypeHelper::UNION_SEPARATOR, $this->getChildTypes());
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}