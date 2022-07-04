<?php

namespace Smpl\Typing\Contracts;

use Stringable;

/**
 * Type Contract
 *
 * This contract represents a type within PHP, and encapsulates any of the logic
 * surrounding that type.
 */
interface Type extends Stringable
{
    /**
     * Get the full name of the type, including any operators or separators.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Is the type one native to PHP.
     *
     * Native types are all types supported by PHPs typing system. Non-native
     * types will typically be encountered in docblocks, and are often used
     * for the purpose of static analysis.
     *
     * @return bool
     */
    public function isNative(): bool;

    /**
     * Does the type accept null.
     *
     * @return bool
     */
    public function isNullable(): bool;

    /**
     * Is the type a primitive type.
     *
     * PHP natively supports 10 primitive types:
     *
     *      bool
     *      int
     *      float (double)
     *      string
     *      array
     *      object
     *      callable
     *      iterable
     *      resource
     *      null
     *
     * @link https://www.php.net/manual/en/language.types.intro.php Type introduction
     *
     * @return bool
     */
    public function isPrimitive(): bool;

    /**
     * Is the type a scalar type.
     *
     * PHP natively supports 4 scalar types:
     *
     *      bool
     *      int
     *      float (double)
     *      string
     *
     * @return bool
     */
    public function isScalar(): bool;

    /**
     * Is the type a compound type.
     *
     * PHP natively supports 4 compound types:
     *
     *      array
     *      object
     *      callable
     *      iterable
     *
     * @return bool
     */
    public function isCompound(): bool;

    /**
     * Is the type a special type.
     *
     * PHP natively supports 3 special types:
     *
     *      resource
     *      false
     *      null
     *
     * @return bool
     */
    public function isSpecial(): bool;

    /**
     * Is the type builtin.
     *
     * Builtin types are all native PHP types that are not classes, both user
     * defined and internal.
     *
     * @return bool
     */
    public function isBuiltin(): bool;

    /**
     * Is the type internal
     *
     * Internals types are classes provided as part of PHP.
     *
     * @return bool
     */
    public function isInternal(): bool;

    /**
     * Is the type user defined.
     *
     * User defined types are classes created in userland. This method serves as
     * the inverse of {@see \Smpl\Typing\Contracts\Type::isInternal()}.
     *
     * @return bool
     */
    public function isUserDefined(): bool;

    /**
     * Is the type a valid parameter type.
     *
     * Parameter types are native types that can be used as parameter types, or,
     * non-native types that can be used in docblocks.
     *
     * @return bool
     */
    public function isParameterType(): bool;

    /**
     * Is the type a valid property type.
     *
     * Property types are native types that can be used as property types, or,
     * non-native types that can be used in docblocks.
     *
     * @return bool
     */
    public function isPropertyType(): bool;

    /**
     * Is the type a valid return type.
     *
     * Return types are native types that can be used as return types, or,
     * non-native types that can be used in docblocks.
     *
     * @return bool
     */
    public function isReturnType(): bool;

    /**
     * Is the type one that can be used alone.
     *
     * Standalone types are types that can be used as parameter, property or
     * return types, without the need for other types. This method will also
     * return true for types that are standalone in docblocks, but not native
     * code.
     *
     * @return bool
     */
    public function isStandaloneType(): bool;

    /**
     * Is the type one that can be natively used alone.
     *
     * Native standalone types are types that can be used as parameter, property
     * or return types, without the use of another type. This method only returns
     * true for native usage outside docblocks.
     *
     * @return bool
     */
    public function isNativeStandaloneType(): bool;

    /**
     * Can the provided type be assigned to the current type.
     *
     * @param \Smpl\Typing\Contracts\Type|string $type
     *
     * @return bool
     */
    public function isAssignableFrom(Type|string $type): bool;

    /**
     * Can the current type be assigned to the provided type.
     *
     * @param \Smpl\Typing\Contracts\Type|string $type
     *
     * @return bool
     */
    public function isAssignableTo(Type|string $type): bool;

    /**
     * Does the type match that of the provided value.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function isOfType(mixed $value): bool;
}