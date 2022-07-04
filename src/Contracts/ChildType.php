<?php

namespace Smpl\Typing\Contracts;

/**
 * Child Type Contract
 *
 * Child types are either more specific than their parent, or an alias. For example
 * the type 'double' is an alias of 'float', whereas 'array' is a more specific
 * version of 'iterable'.
 */
interface ChildType extends Type
{
    /**
     * Get the parent type for the current type.
     *
     * @return \Smpl\Typing\Contracts\Type
     */
    public function getParentType(): Type;

    /**
     * Is the current type an alias of its parent.
     *
     * @return bool
     */
    public function isAlias(): bool;
}