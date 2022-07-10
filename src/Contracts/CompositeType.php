<?php

namespace Smpl\Typing\Contracts;

/**
 * Multi-type Contract
 *
 * This contract represents a type that is either an alias for, or contains
 * multiple other types.
 */
interface CompositeType extends Type
{
    /**
     * Type comparison should use the OR operator.
     */
    public const OR  = 0;

    /**
     * Type comparison should use the AND operator.
     */
    public const AND = 1;

    /**
     * Get the child types for the current type.
     *
     * @return list<\Smpl\Typing\Contracts\Type>
     */
    public function getChildTypes(): array;

    /**
     * Get the mode to use when comparing types.
     *
     * @return int
     */
    public function getComparisonMode(): int;
}