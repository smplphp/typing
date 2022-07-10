<?php

declare(strict_types=1);

namespace Smpl\Typing;

use Closure;
use Smpl\Typing\Exceptions\TypingException;
use Smpl\Typing\Support\ClassHelper;
use Smpl\Typing\Support\TypeHelper;
use Smpl\Typing\Types\Classes\ClassType;
use Smpl\Typing\Types\Classes\EnumType;
use Smpl\Typing\Types\Classes\InterfaceType;
use Smpl\Typing\Types\Classes\TraitType;
use Smpl\Typing\Types\Composites\NullableType;
use Smpl\Typing\Types\Composites\UnionType;
use Stringable;
use Traversable;

final class Types
{
    /**
     * @var array<string, class-string<\Smpl\Typing\Contracts\Type>>
     */
    public const PRIMITIVE_TYPES = [
        // Scalar types
        'bool'     => Types\Primitives\Scalar\BoolType::class,
        'int'      => Types\Primitives\Scalar\IntType::class,
        'float'    => Types\Primitives\Scalar\FloatType::class,
        'string'   => Types\Primitives\Scalar\StringType::class,

        // Compound types
        'array'    => Types\Primitives\Compound\ArrayType::class,
        'object'   => Types\Primitives\Compound\ObjectType::class,
        'callable' => Types\Primitives\Compound\CallableType::class,
        'iterable' => Types\Primitives\Compound\IterableType::class,

        // Special types
        'resource' => Types\Primitives\Special\ResourceType::class,
        'null'     => Types\Primitives\Special\NullType::class,
        'false'    => Types\Primitives\Special\FalseType::class,
    ];

    /**
     * @var array<string, class-string<\Smpl\Typing\Contracts\Type>>
     */
    public const FAKE_TYPES = [
        'double' => Types\Fake\DoubleType::class,
        'true'   => Types\Fake\TrueType::class,
    ];

    /**
     * @var array<class-string, class-string<\Smpl\Typing\Contracts\Type>>
     */
    public const CLASS_TYPES = [
        Closure::class => Types\Classes\Special\ClosureType::class,
    ];

    /**
     * @var array<class-string, class-string<\Smpl\Typing\Contracts\Type>>
     */
    public const SPECIAL_CLASS_TYPES = [
        Stringable::class  => Types\Classes\Special\StringableType::class,
        Traversable::class => Types\Classes\Special\TraversableType::class,
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
     * @var array<string, class-string<\Smpl\Typing\Contracts\Type>>
     */
    private array $mappings = [];

    /**
     * @var array<class-string, class-string<\Smpl\Typing\Contracts\ClassType>>
     */
    private array $classMappings = [];

    /**
     * @var array<class-string, class-string<\Smpl\Typing\Contracts\ClassType>>
     */
    private array $specialClassMappings = [];

    /**
     * @var array<string, \Smpl\Typing\Contracts\Type>
     */
    private array $cachedTypes = [];

    public function __construct()
    {
        $this->registerAll(self::PRIMITIVE_TYPES)
             ->registerAll(self::FAKE_TYPES)
             ->registerAll(self::CLASS_TYPES, true)
             ->registerAll(self::SPECIAL_CLASS_TYPES, true, true);
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

    /**
     * @param string|class-string                       $type
     * @param class-string<\Smpl\Typing\Contracts\Type> $class
     * @param bool                                      $isClass
     * @param bool                                      $isSpecialClass
     *
     * @return static
     *
     * @throws \Smpl\Typing\Exceptions\TypingException
     */
    public function register(string $type, string $class, bool $isClass = false, bool $isSpecialClass = false): self
    {
        if (! ClassHelper::isClass($class)) {
            throw TypingException::invalidClass($class);
        }

        if ($isClass) {
            if (! is_subclass_of($class, Contracts\ClassType::class)) {
                throw TypingException::invalidClassMapping($type, $class);
            }

            if ($isSpecialClass) {
                /** @psalm-suppress PropertyTypeCoercion */
                $this->specialClassMappings[$type] = $class;
            } else {
                /** @psalm-suppress PropertyTypeCoercion */
                $this->classMappings[$type] = $class;
            }
        } else {
            $type                  = strtolower($type);
            $this->mappings[$type] = $class;
        }

        return $this;
    }

    /**
     * @param array<string|class-string, class-string<\Smpl\Typing\Contracts\Type>> $types
     * @param bool                                                                  $isClass
     * @param bool                                                                  $isSpecialClass
     *
     * @return static
     *
     * @throws \Smpl\Typing\Exceptions\TypingException
     */
    public function registerAll(array $types, bool $isClass = false, bool $isSpecialClass = false): self
    {
        foreach ($types as $type => $class) {
            $this->register($type, $class, $isClass, $isSpecialClass);
        }

        return $this;
    }

    public function isMappedType(string $type): bool
    {
        $type = strtolower($type);

        return isset($this->mappings[$type]);
    }

    /**
     * @param string $type
     *
     * @return class-string<\Smpl\Typing\Contracts\Type>|null
     */
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

    /**
     * @param string $type
     *
     * @return class-string<\Smpl\Typing\Contracts\ClassType>|null
     */
    public function getMappedClassType(string $type): ?string
    {
        return $this->classMappings[$type] ?? null;
    }

    /**
     * @param string|class-string $typeName
     *
     * @return \Smpl\Typing\Contracts\Type
     *
     * @throws \Smpl\Typing\Exceptions\TypingException
     */
    public function make(string $typeName): Contracts\Type
    {
        if (TypeHelper::isSingleNullableType($typeName)) {
            if (
                TypeHelper::containsUnionOperator($typeName)
                || TypeHelper::containsIntersectionOperator($typeName)
            ) {
                throw TypingException::invalidMultiType($typeName);
            }

            return $this->makeNullableType(substr($typeName, 1));
        }

        if ($typeName === 'null') {
            return $this->makeBasicType('null');
        }

        if (TypeHelper::containsUnionOperator($typeName)) {
            if (! TypeHelper::isValidUnionType($typeName)) {
                throw TypingException::invalidUnionType($typeName);
            }

            return $this->makeUnionType($typeName);
        }

        if (TypeHelper::containsIntersectionOperator($typeName)) {
            if (! TypeHelper::isValidIntersectionType($typeName)) {
                throw TypingException::invalidIntersectionType($typeName);
            }

            return $this->makeIntersectionType($typeName);
        }

        if (ClassHelper::isValidClass($typeName)) {
            /**
             * @var class-string $typeName
             * @psalm-suppress ArgumentTypeCoercion
             */
            return $this->makeClassType($typeName);
        }

        return $this->makeBasicType($typeName);
    }

    /**
     * @param string|class-string $typeName
     *
     * @return \Smpl\Typing\Types\Composites\NullableType
     *
     * @throws \Smpl\Typing\Exceptions\TypingException
     */
    protected function makeNullableType(string $typeName): NullableType
    {
        if ($typeName === 'null') {
            throw TypingException::compoundNull();
        }

        return new NullableType($this->setCached($this->make($typeName)));
    }

    /**
     * @param string|class-string $typeName
     *
     * @return \Smpl\Typing\Contracts\Type
     *
     * @throws \Smpl\Typing\Exceptions\TypingException
     *
     * @psalm-suppress NullableReturnStatement
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-suppress InvalidNullableReturnType
     */
    protected function makeBasicType(string $typeName): Contracts\Type
    {
        $typeName = strtolower($typeName);

        if ($this->isCached($typeName)) {
            return $this->getCached($typeName);
        }

        $typeClass = $this->getMappedType($typeName);

        if ($typeClass === null) {
            throw TypingException::noMapping($typeName);
        }

        /**
         * @var class-string<\Smpl\Typing\Contracts\Type> $typeClass
         */

        return $this->setCached(new $typeClass);
    }

    /**
     * @param class-string $className
     *
     * @return \Smpl\Typing\Contracts\ClassType
     *
     * @noinspection   PhpIncompatibleReturnTypeInspection
     *
     * @throws \Smpl\Typing\Exceptions\TypingException
     *
     * @psalm-suppress LessSpecificReturnStatement
     * @psalm-suppress NullableReturnStatement
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-suppress InvalidNullableReturnType
     */
    protected function makeClassType(string $className): Contracts\ClassType
    {
        if ($this->isCached($className)) {
            return $this->getCached($className);
        }

        $typeClass = $this->getMappedClassType($className);
        /**
         * @var \Smpl\Typing\Contracts\ClassType|null $classType
         */
        $classType = null;

        if ($typeClass !== null) {
            $classType = new $typeClass;
        } else if (ClassHelper::isEnum($className)) {
            $classType = new EnumType($className);
        } else if (ClassHelper::isInterface($className)) {
            $classType = new InterfaceType($className);
        } else if (ClassHelper::isTrait($className)) {
            $classType = new TraitType($className);
        } else if (ClassHelper::isClass($className)) {
            // The class check should be last, as enums technically appear as
            // valid classes.
            $classType = new ClassType($className);
        }

        if ($classType !== null) {
            foreach ($this->specialClassMappings as $specialClassName => $specialClassType) {
                if ($classType->getName() === $specialClassName || $classType->isSubclassOf($specialClassName)) {
                    $classType = new $specialClassType($classType);
                    break;
                }
            }

            /**
             * @var \Smpl\Typing\Contracts\ClassType $classType
             */

            return $this->setCached($classType);
        }

        throw TypingException::invalidClass($className);
    }

    /**
     * @param string $typeName
     *
     * @return \Smpl\Typing\Contracts\Type
     *
     * @throws \Smpl\Typing\Exceptions\TypingException
     */
    protected function makeUnionType(string $typeName): Contracts\Type
    {
        $typeNames = TypeHelper::getUnionTypesFromType($typeName);
        $subTypes  = [];
        sort($typeNames);

        foreach ($typeNames as $subTypeName) {
            $subTypes[] = $this->make($subTypeName);
        }

        return $this->setCached(new UnionType($subTypes));
    }

    /**
     * @param string $typeName
     *
     * @return \Smpl\Typing\Contracts\Type
     *
     * @throws \Smpl\Typing\Exceptions\TypingException
     */
    protected function makeIntersectionType(string $typeName): Contracts\Type
    {
        $typeNames = TypeHelper::getIntersectionTypesFromType($typeName);
        $subTypes  = [];
        sort($typeNames);

        foreach ($typeNames as $subTypeName) {
            if (! ClassHelper::isValidClass($subTypeName)) {
                throw TypingException::invalidIntersectionType($typeName);
            }

            $subTypes[] = $this->makeClassType($subTypeName);
        }

        return $this->setCached(new UnionType($subTypes));
    }
}