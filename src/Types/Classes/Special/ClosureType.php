<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Classes\Special;

use Closure;
use Smpl\Typing\Concerns\IsChildType;
use Smpl\Typing\Concerns\IsClassType;
use Smpl\Typing\Contracts\ChildType;
use Smpl\Typing\Contracts\ClassType as ClassTypeContract;
use Smpl\Typing\Contracts\Type;
use function Smpl\Typing\type_of;
use function Smpl\Typing\type_of_or_return;

class ClosureType implements ClassTypeContract, ChildType
{
    use IsClassType, IsChildType {
        IsClassType::isAssignableFrom insteadof IsChildType;
        IsClassType::isOfType insteadof IsChildType;
        IsClassType::isAssignableTo as isClassAssignableTo;
        IsChildType::isAssignableTo as isChildAssignableTo;
    }

    public function __construct()
    {
        $this->setParentType(type_of('callable'));
    }

    public function isAlias(): bool
    {
        return false;
    }

    public function getName(): string
    {
        return Closure::class;
    }

    public function isAssignableTo(string|Type $type): bool
    {
        $type = type_of_or_return($type);

        return $this->isClassAssignableTo($type)
            || $this->isChildAssignableTo($type);
    }
}