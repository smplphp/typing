<?php

declare(strict_types=1);

namespace Smpl\Typing\Concerns;

use Smpl\Typing\Contracts\Type;

trait IsChildType
{
    private Type $parentType;

    protected function setParentType(Type $parentType): static
    {
        $this->parentType = $parentType;
        return $this;
    }

    public function getParentType(): Type
    {
        return $this->parentType;
    }

    public function isAssignableFrom(string|Type $type): bool
    {
        return $this->getParentType()->isAssignableFrom($type);
    }

    public function isAssignableTo(string|Type $type): bool
    {
        return $this->getParentType()->isAssignableTo($type);
    }

    public function isOfType(mixed $value): bool
    {
        return $this->getParentType()->isOfType($value);
    }
}