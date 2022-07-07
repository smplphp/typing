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
use Stringable;
use function Smpl\Typing\type_of;

/**
 * @group stringable
 */
class StringableTypeTest extends TestCase
{
    private Type|ChildType $type;

    protected function setUp(): void
    {
        $this->type = type_of(StringableClass::class);
    }

    /**
     * @test
     */
    public function stringable_class_types_are_called_their_class_name(): void
    {
        self::assertSame(StringableClass::class, $this->type->getName());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_called_their_class_name_when_cast_to_string(): void
    {
        self::assertSame(StringableClass::class, (string)$this->type);
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_native(): void
    {
        self::assertFalse($this->type->isNative());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_nullable(): void
    {
        self::assertFalse($this->type->isNullable());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_primitive_types(): void
    {
        self::assertFalse($this->type->isPrimitive());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_scalar_types(): void
    {
        self::assertFalse($this->type->isScalar());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_compound_types(): void
    {
        self::assertFalse($this->type->isCompound());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_composite(): void
    {
        self::assertInstanceOf(CompositeType::class, $this->type);
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_special_types(): void
    {
        self::assertFalse($this->type->isSpecial());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_builtin(): void
    {
        self::assertFalse($this->type->isBuiltin());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_internal_if_the_class_is_not(): void
    {
        self::assertFalse($this->type->isInternal());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_user_defined_if_the_class_is(): void
    {
        self::assertTrue($this->type->isUserDefined());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_parameter_types(): void
    {
        self::assertTrue($this->type->isParameterType());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_property_types(): void
    {
        self::assertTrue($this->type->isPropertyType());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_return_types(): void
    {
        self::assertTrue($this->type->isReturnType());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_standalone_types(): void
    {
        self::assertTrue($this->type->isStandaloneType());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_native_standalone_types(): void
    {
        self::assertTrue($this->type->isNativeStandaloneType());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_child_types(): void
    {
        self::assertNotInstanceOf(ChildType::class, $this->type);
    }

    /**
     * @test
     */
    public function stringable_class_types_inherit_their_type(): void
    {
        self::assertInstanceOf(StringableType::class, $this->type);
        self::assertTrue($this->type->isClass());
        self::assertFalse($this->type->isInterface());
        self::assertFalse($this->type->isEnum());
        self::assertFalse($this->type->isTrait());
    }

    /**
     * @test
     */
    public function stringable_class_types_are_assignable_to_exact_class_types(): void
    {
        self::assertTrue($this->type->isAssignableTo(StringableClass::class));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_assignable_to_string_types(): void
    {
        self::assertTrue($this->type->isAssignableTo('string'));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_assignable_to_parent_class_types(): void
    {
        self::assertTrue($this->type->isAssignableTo(Stringable::class));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_assignable_to_iterable_types_by_default(): void
    {
        self::assertFalse($this->type->isAssignableTo('iterable'));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_assignable_from_array_types(): void
    {
        self::assertFalse($this->type->isAssignableFrom('array'));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_assignable_from_iterable_types(): void
    {
        self::assertFalse($this->type->isAssignableFrom('iterable'));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_assignable_from_their_exact_class(): void
    {
        self::assertTrue($this->type->isAssignableFrom(StringableClass::class));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_assignable_from_their_parent_class(): void
    {
        self::assertFalse($this->type->isAssignableFrom(Stringable::class));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_assignable_from_their_child_class(): void
    {
        self::assertTrue(type_of(Stringable::class)->isAssignableFrom(StringableClass::class));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_subclasses_of_their_parent(): void
    {
        self::assertTrue($this->type->isSubclassOf(Stringable::class));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_subclasses_of_their_children(): void
    {
        self::assertFalse(type_of(Stringable::class)->isSubclassOf(StringableClass::class));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_subclasses_of_non_classes(): void
    {
        self::assertFalse($this->type->isSubclassOf('array'));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_superclasses_of_their_children(): void
    {
        self::assertTrue(type_of(Stringable::class)->isSuperclassOf(StringableClass::class));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_superclasses_of_their_parent(): void
    {
        self::assertFalse($this->type->isSuperclassOf(Stringable::class));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_superclasses_of_non_classes(): void
    {
        self::assertFalse($this->type->isSuperclassOf('array'));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_of_their_class_value_type(): void
    {
        self::assertTrue($this->type->isOfType(new StringableClass()));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_of_other_class_value_type(): void
    {
        self::assertFalse($this->type->isOfType(new IterableClass()));
    }

    /**
     * @test
     */
    public function stringable_class_types_are_not_of_non_class_value_type(): void
    {
        self::assertFalse($this->type->isOfType(true));
        self::assertFalse($this->type->isOfType(1));
        self::assertFalse($this->type->isOfType(1.0));
        self::assertFalse($this->type->isOfType(false));
        self::assertFalse($this->type->isOfType(null));
        self::assertFalse($this->type->isOfType('iterable'));
    }
}