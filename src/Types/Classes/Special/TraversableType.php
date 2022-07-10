<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Classes\Special;

use ReflectionClass;
use Smpl\Typing\Concerns\IsClassType;
use Smpl\Typing\Concerns\IsCompositeType;
use Smpl\Typing\Contracts\ClassType as ClassTypeContract;
use Smpl\Typing\Contracts\CompositeType;
use Smpl\Typing\Contracts\Type;
use function Smpl\Typing\type_of;

class TraversableType implements ClassTypeContract, CompositeType
{
    use IsClassType, IsCompositeType {
        IsCompositeType::isAssignableFrom insteadof IsClassType;
        IsCompositeType::isAssignableTo insteadof IsClassType;
    }

    /**
     * @var \Smpl\Typing\Contracts\ClassType
     */
    private ClassTypeContract $implementation;

    public function __construct(ClassTypeContract $implementation)
    {
        $this->implementation = $implementation;

        $this->setChildTypes([
            $this->implementation,
            type_of('iterable'),
        ]);
    }

    public function getName(): string
    {
        return $this->implementation->getName();
    }

    /** @codeCoverageIgnore  */
    public function getReflection(): ReflectionClass
    {
        return $this->implementation->getReflection();
    }

    public function isInternal(): bool
    {
        return $this->implementation->isInternal();
    }

    public function isUserDefined(): bool
    {
        return $this->implementation->isUserDefined();
    }

    public function isParameterType(): bool
    {
        return $this->implementation->isParameterType();
    }

    public function isPropertyType(): bool
    {
        return $this->implementation->isPropertyType();
    }

    public function isReturnType(): bool
    {
        return $this->implementation->isReturnType();
    }

    public function isSubclassOf(string|Type $type): bool
    {
        return $this->implementation->isSubclassOf($type);
    }

    public function isSuperclassOf(string|Type $type): bool
    {
        return $this->implementation->isSuperclassOf($type);
    }

    public function isAssignableFrom(string|Type $type): bool
    {
        return $this->implementation->isAssignableFrom($type);
    }

    public function isOfType(mixed $value): bool
    {
        return $this->implementation->isOfType($value);
    }

    public function isClass(): bool
    {
        return $this->implementation->isClass();
    }

    public function isInterface(): bool
    {
        return $this->implementation->isInterface();
    }

    public function isTrait(): bool
    {
        return $this->implementation->isTrait();
    }

    public function isEnum(): bool
    {
        return $this->implementation->isEnum();
    }
}