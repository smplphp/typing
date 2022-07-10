<?php

declare(strict_types=1);

namespace Smpl\Typing\Concerns;

trait ProxiesToChildren
{
    use IsCompositeType;

    public function isNative(): bool
    {
        return $this->checkChildrenFor(__METHOD__, false, false);
    }

    public function isNullable(): bool
    {
        return $this->checkChildrenFor(__METHOD__, false, false);
    }

    public function isPrimitive(): bool
    {
        return $this->checkChildrenFor(__METHOD__, false, false);
    }

    public function isScalar(): bool
    {
        return $this->checkChildrenFor(__METHOD__, false, false);
    }

    public function isCompound(): bool
    {
        return $this->checkChildrenFor(__METHOD__, false, false);
    }

    public function isSpecial(): bool
    {
        return $this->checkChildrenFor(__METHOD__, false, false);
    }

    public function isBuiltin(): bool
    {
        return $this->checkChildrenFor(__METHOD__, false, false);
    }

    public function isInternal(): bool
    {
        return $this->checkChildrenFor(__METHOD__, false, false);
    }

    public function isUserDefined(): bool
    {
        return $this->checkChildrenFor(__METHOD__, false, false);
    }

    public function isParameterType(): bool
    {
        return $this->checkChildrenFor(__METHOD__, false, false);
    }

    public function isPropertyType(): bool
    {
        return $this->checkChildrenFor(__METHOD__, false, false);
    }

    public function isReturnType(): bool
    {
        return $this->checkChildrenFor(__METHOD__, false, false);
    }

    public function isStandaloneType(): bool
    {
        return $this->checkChildrenFor(__METHOD__, false, false);
    }

    public function isNativeStandaloneType(): bool
    {
        return $this->checkChildrenFor(__METHOD__, false, false);
    }

    public function isOfType(mixed $value): bool
    {
        return $this->checkChildrenFor(__METHOD__, false, false);
    }
}