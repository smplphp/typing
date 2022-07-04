<?php

declare(strict_types=1);

namespace Smpl\Typing\Support;

final class ClassHelper
{
    public static function isValidClass(string $className): bool
    {
        return self::isClass($className)
            || self::isInterface($className)
            || self::isTrait($className)
            || self::isEnum($className);
    }

    public static function isClass(string $className): bool
    {
        return class_exists($className);
    }

    public static function isInterface(string $className): bool
    {
        return interface_exists($className);
    }

    public static function isTrait(string $className): bool
    {
        return trait_exists($className);
    }

    public static function isEnum(string $className): bool
    {
        return enum_exists($className);
    }
}