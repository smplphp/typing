<?php

declare(strict_types=1);

namespace Smpl\Typing\Tests\Classes;

use PHPUnit\Framework\TestCase;
use Smpl\Typing\Contracts\ChildType;
use Smpl\Typing\Contracts\Type;
use Smpl\Typing\Tests\Fixtures\BasicClass;
use Smpl\Typing\Tests\Fixtures\BasicTrait;
use Smpl\Typing\Tests\Fixtures\IterableClass;
use Smpl\Typing\Tests\Fixtures\StringableClass;
use Smpl\Typing\Types\Classes\ClassType;
use Smpl\Typing\Types\Classes\EnumType;
use Smpl\Typing\Types\Classes\InterfaceType;
use Smpl\Typing\Types\Classes\TraitType;
use function Smpl\Typing\type_of;

/**
 * @group trait
 */
class TraitTypeTest extends TestCase
{
    private Type|ChildType $type;

    protected function setUp(): void
    {
        $this->type = type_of(BasicTrait::class);
    }

    /**
     * @test
     */
    public function trait_types_are_called_their_class_name(): void
    {
        self::assertSame(BasicTrait::class, $this->type->getName());
    }

    /**
     * @test
     */
    public function trait_types_are_called_their_class_name_when_cast_to_string(): void
    {
        self::assertSame(BasicTrait::class, (string)$this->type);
    }

    /**
     * @test
     */
    public function trait_types_are_not_native(): void
    {
        self::assertFalse($this->type->isNative());
    }

    /**
     * @test
     */
    public function trait_types_are_not_nullable(): void
    {
        self::assertFalse($this->type->isNullable());
    }

    /**
     * @test
     */
    public function trait_types_are_not_primitive_types(): void
    {
        self::assertFalse($this->type->isPrimitive());
    }

    /**
     * @test
     */
    public function trait_types_are_not_scalar_types(): void
    {
        self::assertFalse($this->type->isScalar());
    }

    /**
     * @test
     */
    public function trait_types_are_not_compound_types(): void
    {
        self::assertFalse($this->type->isCompound());
    }

    /**
     * @test
     */
    public function trait_types_are_not_special_types(): void
    {
        self::assertFalse($this->type->isSpecial());
    }

    /**
     * @test
     */
    public function trait_types_are_not_builtin(): void
    {
        self::assertFalse($this->type->isBuiltin());
    }

    /**
     * @test
     */
    public function trait_types_are_not_internal(): void
    {
        self::assertFalse($this->type->isInternal());
    }

    /**
     * @test
     */
    public function trait_types_are_user_defined_if_the_class_is(): void
    {
        self::assertTrue($this->type->isUserDefined());
    }

    /**
     * @test
     */
    public function trait_types_are_parameter_types(): void
    {
        self::assertFalse($this->type->isParameterType());
    }

    /**
     * @test
     */
    public function trait_types_are_property_types(): void
    {
        self::assertFalse($this->type->isPropertyType());
    }

    /**
     * @test
     */
    public function trait_types_are_return_types(): void
    {
        self::assertTrue($this->type->isReturnType());
    }

    /**
     * @test
     */
    public function trait_types_are_standalone_types(): void
    {
        self::assertTrue($this->type->isStandaloneType());
    }

    /**
     * @test
     */
    public function trait_types_are_native_standalone_types(): void
    {
        self::assertTrue($this->type->isNativeStandaloneType());
    }

    /**
     * @test
     */
    public function trait_types_are_not_child_types(): void
    {
        self::assertNotInstanceOf(ChildType::class, $this->type);
    }

    /**
     * @test
     */
    public function trait_types_are_not_classes(): void
    {
        self::assertNotInstanceOf(ClassType::class, $this->type);
        self::assertFalse($this->type->isClass());
    }

    /**
     * @test
     */
    public function trait_types_are_not_interfaces(): void
    {
        self::assertNotInstanceOf(InterfaceType::class, $this->type);
        self::assertFalse($this->type->isInterface());
    }

    /**
     * @test
     */
    public function trait_types_are_not_enums(): void
    {
        self::assertNotInstanceOf(EnumType::class, $this->type);
        self::assertFalse($this->type->isEnum());
    }

    /**
     * @test
     */
    public function trait_types_are_traits(): void
    {
        self::assertInstanceOf(TraitType::class, $this->type);
        self::assertTrue($this->type->isTrait());
    }

    /**
     * @test
     */
    public function trait_types_are_assignable_to_exact_class_types(): void
    {
        self::assertTrue($this->type->isAssignableTo(BasicTrait::class));
    }

    /**
     * @test
     */
    public function trait_types_are_not_assignable_to_iterable_types(): void
    {
        self::assertFalse($this->type->isAssignableTo('iterable'));
    }

    /**
     * @test
     */
    public function trait_types_are_not_assignable_from_array_types(): void
    {
        self::assertFalse($this->type->isAssignableFrom('array'));
    }

    /**
     * @test
     */
    public function trait_types_are_not_assignable_from_iterable_types(): void
    {
        self::assertFalse($this->type->isAssignableFrom('iterable'));
    }

    /**
     * @test
     */
    public function trait_types_are_not_of_implementors_value_type(): void
    {
        self::assertFalse($this->type->isOfType(new BasicClass()));
    }

    /**
     * @test
     */
    public function trait_types_are_not_of_other_class_value_type(): void
    {
        self::assertFalse($this->type->isOfType(new IterableClass()));
        self::assertFalse($this->type->isOfType(new StringableClass()));
    }

    /**
     * @test
     */
    public function trait_types_are_not_of_non_class_value_type(): void
    {
        self::assertFalse($this->type->isOfType(true));
        self::assertFalse($this->type->isOfType(1));
        self::assertFalse($this->type->isOfType(1.0));
        self::assertFalse($this->type->isOfType(false));
        self::assertFalse($this->type->isOfType(null));
        self::assertFalse($this->type->isOfType('iterable'));
    }
}