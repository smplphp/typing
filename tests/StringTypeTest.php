<?php

declare(strict_types=1);

namespace Smpl\Typing\Tests;

use PHPUnit\Framework\TestCase;
use Smpl\Typing\Contracts\ChildType;
use Smpl\Typing\Contracts\Type;
use Smpl\Typing\Tests\Fixtures\StringableClass;
use Smpl\Typing\Types\Primitives\Compound\IterableType;
use function Smpl\Typing\type_of;

/**
 * @group string
 */
class StringTypeTest extends TestCase
{
    private Type|ChildType $type;

    protected function setUp(): void
    {
        $this->type = type_of('string');
    }

    /**
     * @test
     */
    public function string_types_are_called_array(): void
    {
        self::assertSame('string', $this->type->getName());
    }

    /**
     * @test
     */
    public function string_types_are_called_array_when_cast_to_string(): void
    {
        self::assertSame('string', (string)$this->type);
    }

    /**
     * @test
     */
    public function string_types_are_native(): void
    {
        self::assertTrue($this->type->isNative());
    }

    /**
     * @test
     */
    public function string_types_are_not_nullable(): void
    {
        self::assertFalse($this->type->isNullable());
    }

    /**
     * @test
     */
    public function string_types_are_primitive_types(): void
    {
        self::assertTrue($this->type->isPrimitive());
    }

    /**
     * @test
     */
    public function string_types_are_scalar_types(): void
    {
        self::assertTrue($this->type->isScalar());
    }

    /**
     * @test
     */
    public function string_types_are_not_compound_types(): void
    {
        self::assertFalse($this->type->isCompound());
    }

    /**
     * @test
     */
    public function string_types_are_not_special_types(): void
    {
        self::assertFalse($this->type->isSpecial());
    }

    /**
     * @test
     */
    public function string_types_are_builtin(): void
    {
        self::assertTrue($this->type->isBuiltin());
    }

    /**
     * @test
     */
    public function string_types_are_not_internal(): void
    {
        self::assertFalse($this->type->isInternal());
    }

    /**
     * @test
     */
    public function string_types_are_not_user_defined(): void
    {
        self::assertFalse($this->type->isUserDefined());
    }

    /**
     * @test
     */
    public function string_types_are_parameter_types(): void
    {
        self::assertTrue($this->type->isParameterType());
    }

    /**
     * @test
     */
    public function string_types_are_property_types(): void
    {
        self::assertTrue($this->type->isPropertyType());
    }

    /**
     * @test
     */
    public function string_types_are_return_types(): void
    {
        self::assertTrue($this->type->isReturnType());
    }

    /**
     * @test
     */
    public function string_types_are_standalone_types(): void
    {
        self::assertTrue($this->type->isStandaloneType());
    }

    /**
     * @test
     */
    public function string_types_are_native_standalone_types(): void
    {
        self::assertTrue($this->type->isNativeStandaloneType());
    }

    /**
     * @test
     */
    public function string_types_are_not_child_types(): void
    {
        self::assertNotInstanceOf(ChildType::class, $this->type, 'String type is a child type');
    }

    /**
     * @test
     */
    public function string_types_are_assignable_to_string_types(): void
    {
        self::assertTrue($this->type->isAssignableTo('string'));
    }

    /**
     * @test
     */
    public function string_types_are_not_assignable_to_stringable_class_types(): void
    {
        self::assertFalse($this->type->isAssignableTo(StringableClass::class));
    }

    /**
     * @test
     */
    public function string_types_are_assignable_from_string_types(): void
    {
        self::assertTrue($this->type->isAssignableFrom('string'));
    }

    /**
     * @test
     */
    public function string_types_are_assignable_from_stringable_class_types(): void
    {
        self::assertTrue($this->type->isAssignableFrom(StringableClass::class));
    }

    /**
     * @test
     */
    public function string_types_are_of_string_value_type(): void
    {
        self::assertTrue($this->type->isOfType('I am a string'));
    }

    /**
     * @test
     */
    public function string_types_are_of_stringable_value_type(): void
    {
        self::assertTrue($this->type->isOfType(new StringableClass()));
    }
}