<?php

declare(strict_types=1);

namespace Smpl\Typing\Tests;

use PHPUnit\Framework\TestCase;
use Smpl\Typing\Contracts\ChildType;
use Smpl\Typing\Contracts\Type;
use Smpl\Typing\Tests\Fixtures\IterableClass;
use Smpl\Typing\Tests\Fixtures\StringableClass;
use Smpl\Typing\Types\Primitives\Compound\IterableType;
use function Smpl\Typing\type_of;

/**
 * @group iterable
 */
class IterableTypeTest extends TestCase
{
    private Type|ChildType $type;

    protected function setUp(): void
    {
        $this->type = type_of('iterable');
    }

    /**
     * @test
     */
    public function iterable_types_are_called_array(): void
    {
        self::assertSame('iterable', $this->type->getName());
    }

    /**
     * @test
     */
    public function iterable_types_are_called_array_when_cast_to_string(): void
    {
        self::assertSame('iterable', (string)$this->type);
    }

    /**
     * @test
     */
    public function iterable_types_are_native(): void
    {
        self::assertTrue($this->type->isNative());
    }

    /**
     * @test
     */
    public function iterable_types_are_not_nullable(): void
    {
        self::assertFalse($this->type->isNullable());
    }

    /**
     * @test
     */
    public function iterable_types_are_primitive_types(): void
    {
        self::assertTrue($this->type->isPrimitive());
    }

    /**
     * @test
     */
    public function iterable_types_are_not_scalar_types(): void
    {
        self::assertFalse($this->type->isScalar());
    }

    /**
     * @test
     */
    public function iterable_types_are_compound_types(): void
    {
        self::assertTrue($this->type->isCompound());
    }

    /**
     * @test
     */
    public function iterable_types_are_not_special_types(): void
    {
        self::assertFalse($this->type->isSpecial());
    }

    /**
     * @test
     */
    public function iterable_types_are_builtin(): void
    {
        self::assertTrue($this->type->isBuiltin());
    }

    /**
     * @test
     */
    public function iterable_types_are_not_internal(): void
    {
        self::assertFalse($this->type->isInternal());
    }

    /**
     * @test
     */
    public function iterable_types_are_not_user_defined(): void
    {
        self::assertFalse($this->type->isUserDefined());
    }

    /**
     * @test
     */
    public function iterable_types_are_parameter_types(): void
    {
        self::assertTrue($this->type->isParameterType());
    }

    /**
     * @test
     */
    public function iterable_types_are_property_types(): void
    {
        self::assertTrue($this->type->isPropertyType());
    }

    /**
     * @test
     */
    public function iterable_types_are_return_types(): void
    {
        self::assertTrue($this->type->isReturnType());
    }

    /**
     * @test
     */
    public function iterable_types_are_standalone_types(): void
    {
        self::assertTrue($this->type->isStandaloneType());
    }

    /**
     * @test
     */
    public function iterable_types_are_native_standalone_types(): void
    {
        self::assertTrue($this->type->isNativeStandaloneType());
    }

    /**
     * @test
     */
    public function iterable_types_are_not_child_types(): void
    {
        self::assertNotInstanceOf(ChildType::class, $this->type, 'Iterable type is a child type');
    }

    /**
     * @test
     */
    public function iterable_types_are_assignable_to_iterable_types(): void
    {
        self::assertTrue($this->type->isAssignableTo('iterable'));
    }

    /**
     * @test
     */
    public function iterable_types_are_not_assignable_to_array_types(): void
    {
        self::assertFalse($this->type->isAssignableTo('array'));
    }

    /**
     * @test
     */
    public function iterable_types_are_not_assignable_to_iterable_class_types(): void
    {
        self::assertFalse($this->type->isAssignableTo(IterableClass::class));
    }

    /**
     * @test
     */
    public function iterable_types_are_assignable_from_iterable_types(): void
    {
        self::assertTrue($this->type->isAssignableFrom('iterable'));
    }

    /**
     * @test
     */
    public function iterable_types_are_assignable_from_array_types(): void
    {
        self::assertTrue($this->type->isAssignableFrom('array'));
    }

    /**
     * @test
     */
    public function iterable_types_are_assignable_from_iterable_class_types(): void
    {
        self::assertTrue($this->type->isAssignableFrom(IterableClass::class));
    }

    /**
     * @test
     */
    public function iterable_types_are_of_iterable_value_type(): void
    {
        self::assertTrue($this->type->isOfType(new IterableClass()));
    }

    /**
     * @test
     */
    public function iterable_types_are_of_array_value_type(): void
    {
        self::assertTrue($this->type->isOfType([]));
    }

    /**
     * @test
     */
    public function string_types_are_not_of_non_iterable_value_type(): void
    {
        self::assertFalse($this->type->isOfType(true));
        self::assertFalse($this->type->isOfType(1));
        self::assertFalse($this->type->isOfType(1.0));
        self::assertFalse($this->type->isOfType(false));
        self::assertFalse($this->type->isOfType(null));
        self::assertFalse($this->type->isOfType('iterable'));
        self::assertFalse($this->type->isOfType(new StringableClass()));
    }
}