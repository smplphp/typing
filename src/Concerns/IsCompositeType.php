<?php

declare(strict_types=1);

namespace Smpl\Typing\Concerns;

use Smpl\Typing\Contracts\CompositeType;
use Smpl\Typing\Contracts\Type;

/**
 *
 */
trait IsCompositeType
{
    private array $childTypes = [];

    private int $comparisonMode = CompositeType::OR;

    /** @infection-ignore-all  */
    protected function setChildTypes(array $childTypes): static
    {
        $this->childTypes = $childTypes;
        return $this;
    }

    protected function setComparisonMode(int $comparisonMode): static
    {
        $this->comparisonMode = $comparisonMode;
        return $this;
    }

    public function getChildTypes(): array
    {
        return $this->childTypes;
    }

    public function getComparisonMode(): int
    {
        return $this->comparisonMode;
    }

    public function isAssignableFrom(string|Type $type): bool
    {
        foreach ($this->getChildTypes() as $childType) {
            if ($childType->isAssignableFrom($type)) {
                if ($this->getComparisonMode() === CompositeType::OR) {
                    return true;
                }
            } else if ($this->getComparisonMode() === CompositeType::AND) {
                return false;
            }
        }

        return false;
    }

    public function isAssignableTo(string|Type $type): bool
    {
        foreach ($this->getChildTypes() as $childType) {
            if ($childType->isAssignableTo($type)) {
                if ($this->getComparisonMode() === CompositeType::OR) {
                    return true;
                }
            } else if ($this->getComparisonMode() === CompositeType::AND) {
                return false;
            }
        }

        return false;
    }

    protected function checkChildrenFor(string $method, bool $compareTo, bool $return): bool
    {
        foreach ($this->getChildTypes() as $childType) {
            if ($childType->{$method}() === $compareTo) {
                return $return;
            }
        }

        return ! $return;
    }
}