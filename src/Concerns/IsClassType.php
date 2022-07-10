<?php

declare(strict_types=1);

namespace Smpl\Typing\Concerns;

use ReflectionClass;
use Smpl\Typing\Contracts\ClassType;
use Smpl\Typing\Contracts\Type;
use function Smpl\Typing\type_of_or_return;

trait IsClassType
{
    private ReflectionClass $reflection;

    /**
     * @var class-string
     */
    private string $className;

    /**
     * @param class-string $className
     *
     * @return static
     */
    protected function setClassName(string $className): static
    {
        $this->className = $className;
        return $this;
    }

    /**
     * @return class-string
     */
    public function getName(): string
    {
        return $this->className;
    }

    /**
     * @return \ReflectionClass
     * @throws \ReflectionException
     *
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function getReflection(): ReflectionClass
    {
        if (! isset($this->reflection)) {
            $this->reflection = new ReflectionClass($this->getName());
        }

        return $this->reflection;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function isNative(): bool
    {
        return false;
    }

    public function isNullable(): bool
    {
        return false;
    }

    public function isPrimitive(): bool
    {
        return false;
    }

    public function isScalar(): bool
    {
        return false;
    }

    public function isCompound(): bool
    {
        return false;
    }

    public function isSpecial(): bool
    {
        return false;
    }

    public function isBuiltin(): bool
    {
        return false;
    }

    public function isInternal(): bool
    {
        return $this->getReflection()->isInternal();
    }

    public function isUserDefined(): bool
    {
        return $this->getReflection()->isUserDefined();
    }

    public function isParameterType(): bool
    {
        return true;
    }

    public function isPropertyType(): bool
    {
        return true;
    }

    public function isReturnType(): bool
    {
        return true;
    }

    public function isStandaloneType(): bool
    {
        return true;
    }

    public function isNativeStandaloneType(): bool
    {
        return true;
    }

    public function isAssignableFrom(string|Type $type): bool
    {
        $type = type_of_or_return($type);

        if (! ($type instanceof ClassType)) {
            return false;
        }

        return $type->getName() === $this->getName() || $type->isSubclassOf($this);
    }

    public function isAssignableTo(string|Type $type): bool
    {
        $type = type_of_or_return($type);

        if (! ($type instanceof ClassType)) {
            return false;
        }

        return $type->getName() === $this->getName() || $type->isSuperclassOf($this);
    }

    public function isSubclassOf(string|Type $type): bool
    {
        $type = type_of_or_return($type);

        if (! ($type instanceof ClassType)) {
            return false;
        }

        return is_subclass_of($this->getName(), $type->getName());
    }

    public function isSuperclassOf(string|Type $type): bool
    {
        $type = type_of_or_return($type);

        if (! ($type instanceof ClassType)) {
            return false;
        }

        return is_subclass_of($type->getName(), $this->getName());
    }

    public function isOfType(mixed $value): bool
    {
        if (! is_object($value)) {
            return false;
        }

        $className = $this->getName();

        return $value instanceof $className || $this->isSubclassOf($value::class);
    }

    public function isClass(): bool
    {
        return false;
    }

    public function isInterface(): bool
    {
        return false;
    }

    public function isTrait(): bool
    {
        return false;
    }

    public function isEnum(): bool
    {
        return false;
    }
}