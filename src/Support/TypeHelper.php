<?php

declare(strict_types=1);

namespace Smpl\Typing\Support;

final class TypeHelper
{
    public final const NULLABLE_IDENTIFIER    = '?';

    public final const UNION_SEPARATOR        = '|';

    public final const INTERSECTION_SEPARATOR = '&';

    public static function isSingleNullableType(string $typeName): bool
    {
        return str_starts_with($typeName, self::NULLABLE_IDENTIFIER);
    }

    public static function containsUnionOperator(string $typeName): bool
    {
        return str_contains($typeName, self::UNION_SEPARATOR);
    }

    public static function containsIntersectionOperator(string $typeName): bool
    {
        return str_contains($typeName, self::INTERSECTION_SEPARATOR);
    }

    public static function isValidUnionType(string $typeName): bool
    {
        return ! str_starts_with($typeName, self::UNION_SEPARATOR)
            && ! str_ends_with($typeName, self::UNION_SEPARATOR);
    }

    public static function isValidIntersectionType(string $typeName): bool
    {
        return ! str_starts_with($typeName, self::INTERSECTION_SEPARATOR)
            && ! str_ends_with($typeName, self::INTERSECTION_SEPARATOR);
    }

    /**
     * @param string $typeName
     *
     * @return array<string|class-string>
     */
    public static function getUnionTypesFromType(string $typeName): array
    {
        return explode(self::UNION_SEPARATOR, $typeName);
    }

    /**
     * @param string $typeName
     *
     * @return class-string[]
     *
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-suppress LessSpecificReturnStatement
     */
    public static function getIntersectionTypesFromType(string $typeName): array
    {
        return explode(self::INTERSECTION_SEPARATOR, $typeName);
    }
}