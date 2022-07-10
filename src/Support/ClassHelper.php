<?php

declare(strict_types=1);

namespace Smpl\Typing\Support;

final class ClassHelper
{
    /**
     * @param string|class-string $className
     *
     * @return bool
     */
    public static function isValidClass(string $className): bool
    {
        return self::isClass($className)
            || self::isInterface($className)
            || self::isTrait($className)
            || self::isEnum($className);
    }

    /**
     * @param string|class-string $className
     *
     * @return bool
     */
    public static function isClass(string $className): bool
    {
        return class_exists($className);
    }

    /**
     * @param string|class-string $className
     *
     * @return bool
     */
    public static function isInterface(string $className): bool
    {
        return interface_exists($className);
    }

    /**
     * @param string|class-string $className
     *
     * @return bool
     */
    public static function isTrait(string $className): bool
    {
        return trait_exists($className);
    }

    /**
     * @param string|class-string $className
     *
     * @return bool
     */
    public static function isEnum(string $className): bool
    {
        /** @psalm-suppress ArgumentTypeCoercion */
        return enum_exists($className);
    }
}