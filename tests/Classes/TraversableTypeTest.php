<?php

declare(strict_types=1);

namespace Smpl\Typing\Tests\Classes;

use PHPUnit\Framework\TestCase;
use Smpl\Typing\Contracts\ChildType;
use Smpl\Typing\Contracts\CompositeType;
use Smpl\Typing\Contracts\Type;
use Smpl\Typing\Tests\Fixtures\IterableClass;
use Smpl\Typing\Tests\Fixtures\StringableClass;
use Smpl\Typing\Types\Classes\Special\StringableType;
use Smpl\Typing\Types\Classes\Special\TraversableType;
use Stringable;
use Traversable;
use function Smpl\Typing\type_of;

/**
 * @group traversable
 */
class TraversableTypeTest extends TestCase
{
    private Type|ChildType $type;

    protected function setUp(): void
    {
        $this->type = type_of(IterableClass::class);
    }

    /**
     * @test
     */
    public function traversable_class_types_are_called_their_class_name(): void
    {
        self::assertSame(IterableClass::class, $this->type->getName());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_called_their_class_name_when_cast_to_string(): void
    {
        self::assertSame(IterableClass::class, (string)$this->type);
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_native(): void
    {
        self::assertFalse($this->type->isNative());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_nullable(): void
    {
        self::assertFalse($this->type->isNullable());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_primitive_types(): void
    {
        self::assertFalse($this->type->isPrimitive());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_scalar_types(): void
    {
        self::assertFalse($this->type->isScalar());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_compound_types(): void
    {
        self::assertFalse($this->type->isCompound());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_composite(): void
    {
        self::assertInstanceOf(CompositeType::class, $this->type);
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_special_types(): void
    {
        self::assertFalse($this->type->isSpecial());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_builtin(): void
    {
        self::assertFalse($this->type->isBuiltin());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_internal_if_the_class_is_not(): void
    {
        self::assertFalse($this->type->isInternal());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_user_defined_if_the_class_is(): void
    {
        self::assertTrue($this->type->isUserDefined());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_parameter_types(): void
    {
        self::assertTrue($this->type->isParameterType());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_property_types(): void
    {
        self::assertTrue($this->type->isPropertyType());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_return_types(): void
    {
        self::assertTrue($this->type->isReturnType());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_standalone_types(): void
    {
        self::assertTrue($this->type->isStandaloneType());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_native_standalone_types(): void
    {
        self::assertTrue($this->type->isNativeStandaloneType());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_child_types(): void
    {
        self::assertNotInstanceOf(ChildType::class, $this->type);
    }

    /**
     * @test
     */
    public function traversable_class_types_inherit_their_type(): void
    {
        self::assertInstanceOf(TraversableType::class, $this->type);
        self::assertTrue($this->type->isClass());
        self::assertFalse($this->type->isInterface());
        self::assertFalse($this->type->isEnum());
        self::assertFalse($this->type->isTrait());
    }

    /**
     * @test
     */
    public function traversable_class_types_are_assignable_to_exact_class_types(): void
    {
        self::assertTrue($this->type->isAssignableTo(IterableClass::class));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_assignable_to_iterable_types(): void
    {
        self::assertTrue($this->type->isAssignableTo('iterable'));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_assignable_to_parent_class_types(): void
    {
        self::assertTrue($this->type->isAssignableTo(Traversable::class));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_assignable_from_array_types(): void
    {
        self::assertFalse($this->type->isAssignableFrom('array'));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_assignable_from_iterable_types(): void
    {
        self::assertFalse($this->type->isAssignableFrom('iterable'));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_assignable_from_their_exact_class(): void
    {
        self::assertTrue($this->type->isAssignableFrom(IterableClass::class));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_assignable_from_their_parent_class(): void
    {
        self::assertFalse($this->type->isAssignableFrom(Traversable::class));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_assignable_from_their_child_class(): void
    {
        self::assertTrue(type_of(Traversable::class)->isAssignableFrom(IterableClass::class));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_subclasses_of_their_parent(): void
    {
        self::assertTrue($this->type->isSubclassOf(Traversable::class));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_subclasses_of_their_children(): void
    {
        self::assertFalse(type_of(Traversable::class)->isSubclassOf(IterableClass::class));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_subclasses_of_non_classes(): void
    {
        self::assertFalse($this->type->isSubclassOf('array'));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_superclasses_of_their_children(): void
    {
        self::assertTrue(type_of(Traversable::class)->isSuperclassOf(IterableClass::class));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_superclasses_of_their_parent(): void
    {
        self::assertFalse($this->type->isSuperclassOf(Traversable::class));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_superclasses_of_non_classes(): void
    {
        self::assertFalse($this->type->isSuperclassOf('array'));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_of_their_class_value_type(): void
    {
        self::assertTrue($this->type->isOfType(new IterableClass()));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_of_other_class_value_type(): void
    {
        self::assertFalse($this->type->isOfType(new StringableClass()));
    }

    /**
     * @test
     */
    public function traversable_class_types_are_not_of_non_class_value_type(): void
    {
        self::assertFalse($this->type->isOfType(true));
        self::assertFalse($this->type->isOfType(1));
        self::assertFalse($this->type->isOfType(1.0));
        self::assertFalse($this->type->isOfType(false));
        self::assertFalse($this->type->isOfType(null));
        self::assertFalse($this->type->isOfType([]));
        self::assertFalse($this->type->isOfType('iterable'));
    }
}