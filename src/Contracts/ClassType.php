<?php

namespace Smpl\Typing\Contracts;

use ReflectionClass;
use Reflector;

/**
 * Class Type Contract
 *
 * This contract represents classes, interfaces, traits and enums.
 */
interface ClassType extends Type
{
    /**
     * Get the full qualified name of the class.
     *
     * @return class-string
     */
    public function getName(): string;

    /**
     * Get a reflection instance for the class.
     *
     * @return \ReflectionClass
     */
    public function getReflection(): ReflectionClass;

    /**
     * Is the current class a subclass of the provided class.
     *
     * @param \Smpl\Typing\Contracts\Type|string $type
     *
     * @return bool
     */
    public function isSubclassOf(Type|string $type): bool;

    /**
     * Is the current class a superclass of the provided class.
     *
     * @param \Smpl\Typing\Contracts\Type|string $type
     *
     * @return bool
     */
    public function isSuperclassOf(Type|string $type): bool;

    /**
     * Is the current class an actual class.
     *
     * @return bool
     */
    public function isClass(): bool;

    /**
     * Is the current class an interface.
     *
     * @return bool
     */
    public function isInterface(): bool;

    /**
     * Is the current class a trait.
     *
     * @return bool
     */
    public function isTrait(): bool;

    /**
     * Is the current class an enum.
     *
     * @return bool
     */
    public function isEnum(): bool;
}