<?php

declare(strict_types=1);

namespace Smpl\Typing;

use Smpl\Typing\Support\ClassHelper;

function type_of(string $type): Contracts\Type
{
    return Types::getInstance()->make($type);
}

function type_of_or_return(string|Contracts\Type $type): Contracts\Type
{
    return $type instanceof Contracts\Type ? $type : type_of($type);
}

function type_from(mixed $value): Contracts\Type
{
    return type_of(get_debug_type($value));
}

function is_class(string $className): bool
{
    return ClassHelper::isClass($className);
}

function is_interface(string $className): bool
{
    return ClassHelper::isInterface($className);
}

function is_trait(string $className): bool
{
    return ClassHelper::isTrait($className);
}

function is_enum(string $className): bool
{
    return ClassHelper::isEnum($className);
}