<?php

declare(strict_types=1);

namespace Smpl\Typing;

use Smpl\Typing\Exceptions\TypingException;
use Smpl\Typing\Support\ClassHelper;
use Smpl\Typing\Types\Classes\ClassType;
use Smpl\Typing\Types\Classes\EnumType;
use Smpl\Typing\Types\Classes\InterfaceType;
use Smpl\Typing\Types\Classes\TraitType;

final class Types
{
    public const PRIMITIVE_TYPES = [
        // Scalar types
        'bool'     => Types\Primitives\Scalar\BoolType::class,
        'int'      => Types\Primitives\Scalar\IntType::class,
        'float'    => Types\Primitives\Scalar\FloatType::class,
        'string'   => Types\Primitives\Scalar\StringType::class,

        // Compound types
        'array'    => Types\Primitives\Compound\ArrayType::class,
        //'object'   => Types\Primitives\Compound\ObjectType::class,
        //'callable' => Types\Primitives\Compound\CallableType::class,
        'iterable' => Types\Primitives\Compound\IterableType::class,

        // Special types
        //'resource' => Types\Primitives\Special\ResourceType::class,
        //'null'     => Types\Primitives\Special\NullType::class,
        'false'    => Types\Primitives\Special\FalseType::class,
        // This is a non-native special type
        'true'     => Types\Primitives\Special\TrueType::class,
    ];

    public const ALIAS_TYPES = [
        'double' => Types\Aliases\DoubleType::class,
    ];

    private static self $instance;

    public static function getInstance(): self
    {
        if (! isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @var array<string, class-string>
     */
    private array $mappings = [];

    /**
     * @var array<class-string, class-string>
     */
    private array $classMappings = [];

    /**
     * @var array<string, \Smpl\Typing\Contracts\Type>
     */
    private array $cachedTypes = [];

    public function __construct()
    {
        $this->registerAll(self::PRIMITIVE_TYPES)
             ->registerAll(self::ALIAS_TYPES);
    }

    private function isCached(string $typeName): bool
    {
        return isset($this->cachedTypes[$typeName]);
    }

    private function getCached(string $typeName): ?Contracts\Type
    {
        return $this->cachedTypes[$typeName] ?? null;
    }

    private function setCached(Contracts\Type $type): Contracts\Type
    {
        $this->cachedTypes[$type->getName()] = $type;
        return $type;
    }

    public function register(string $type, string $class, bool $isClass = false): self
    {
        if (! ClassHelper::isClass($class)) {
            throw TypingException::invalidClass($class);
        }

        if ($isClass) {
            $this->classMappings[$type] = $class;
        } else {
            $type                  = strtolower($type);
            $this->mappings[$type] = $class;
        }

        return $this;
    }

    public function registerAll(iterable $types, bool $isClass = false): self
    {
        foreach ($types as $type => $class) {
            $this->register($type, $class, $isClass);
        }

        return $this;
    }

    public function isMappedType(string $type): bool
    {
        $type = strtolower($type);

        return isset($this->mappings[$type]);
    }

    public function getMappedType(string $type): ?string
    {
        $type = strtolower($type);

        return $this->mappings[$type] ?? null;
    }

    public function isMappedClassType(string $type): bool
    {
        $type = strtolower($type);

        return isset($this->mappings[$type]);
    }

    public function getMappedClassType(string $type): ?string
    {
        return $this->classMappings[$type] ?? null;
    }

    public function make(string $typeName): Contracts\Type
    {
        if (ClassHelper::isValidClass($typeName)) {
            return $this->makeClassType($typeName);
        }

        $typeName = strtolower($typeName);

        if ($this->isCached($typeName)) {
            return $this->getCached($typeName);
        }

        $typeClass = $this->getMappedType($typeName);

        if ($typeClass === null) {
            throw TypingException::noMapping($typeName);
        }

        return $this->setCached(new $typeClass);
    }

    /** @noinspection PhpIncompatibleReturnTypeInspection */
    public function makeClassType(string $className): Contracts\ClassType
    {
        if ($this->isCached($className)) {
            return $this->getCached($className);
        }

        $typeClass = $this->getMappedClassType($className);

        if ($typeClass !== null) {
            return $this->setCached(new $typeClass);
        }

        if (ClassHelper::isClass($className)) {
            return $this->setCached(new ClassType($className));
        }

        if (ClassHelper::isInterface($className)) {
            return $this->setCached(new InterfaceType($className));
        }

        if (ClassHelper::isTrait($className)) {
            return $this->setCached(new TraitType($className));
        }

        if (ClassHelper::isEnum($className)) {
            return $this->setCached(new EnumType($className));
        }
    }
}