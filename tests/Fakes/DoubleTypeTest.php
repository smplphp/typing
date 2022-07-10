<?php

declare(strict_types=1);

namespace Smpl\Typing\Tests\Fakes;

use PHPUnit\Framework\TestCase;
use Smpl\Typing\Contracts\ChildType;
use Smpl\Typing\Contracts\Type;
use Smpl\Typing\Tests\Fixtures\BasicClass;
use Smpl\Typing\Tests\Fixtures\BasicEnum;
use Smpl\Typing\Tests\Fixtures\BasicInterface;
use Smpl\Typing\Tests\Fixtures\BasicTrait;
use Smpl\Typing\Tests\Fixtures\IterableClass;
use Smpl\Typing\Tests\Fixtures\StringableClass;
use stdClass;
use Stringable;
use Traversable;
use function Smpl\Typing\type_of;

/**
 * @group types
 * @group primitives
 * @group fake
 * @group float
 * @group double
 */
class DoubleTypeTest extends TestCase
{
    private Type $type;

    protected function setUp(): void
    {
        $this->type = type_of('double');
    }

    /**
     * @test
     */
    public function double_types_are_named_double(): void
    {
        $this->assertEquals('double', $this->type->getName());
    }

    /**
     * @test
     */
    public function double_types_use_their_name_when_cast_to_a_string(): void
    {
        $this->assertEquals('double', (string)$this->type);
    }

    /**
     * @test
     */
    public function double_types_are_aliases(): void
    {
        $this->assertInstanceOf(ChildType::class, $this->type);
        $this->assertTrue($this->type->isAlias());
    }

    /**
     * @test
     */
    public function double_types_are_not_native(): void
    {
        $this->assertFalse($this->type->isNative());
    }

    /**
     * @test
     */
    public function double_types_are_not_nullable(): void
    {
        $this->assertFalse($this->type->isNullable());
    }

    /**
     * @test
     */
    public function double_types_are_primitive(): void
    {
        $this->assertTrue($this->type->isPrimitive());
    }

    /**
     * @test
     */
    public function double_types_are_scalar(): void
    {
        $this->assertTrue($this->type->isScalar());
    }

    /**
     * @test
     */
    public function double_types_are_not_compound(): void
    {
        $this->assertFalse($this->type->isCompound());
    }

    /**
     * @test
     */
    public function double_types_are_not_special(): void
    {
        $this->assertFalse($this->type->isSpecial());
    }

    /**
     * @test
     */
    public function double_types_not_are_builtin(): void
    {
        $this->assertFalse($this->type->isBuiltin());
    }

    /**
     * @test
     */
    public function double_types_are_not_internal(): void
    {
        $this->assertFalse($this->type->isInternal());
    }

    /**
     * @test
     */
    public function double_types_are_not_user_defined(): void
    {
        $this->assertFalse($this->type->isUserDefined());
    }

    /**
     * @test
     */
    public function double_types_are_standalone_types(): void
    {
        $this->assertTrue($this->type->isStandaloneType());
    }

    /**
     * @test
     */
    public function double_types_are_not_native_standalone_types(): void
    {
        $this->assertFalse($this->type->isNativeStandaloneType());
    }

    /**
     * @test
     */
    public function double_types_can_be_parameter_types(): void
    {
        $this->assertTrue($this->type->isParameterType());
    }

    /**
     * @test
     */
    public function double_types_can_be_property_types(): void
    {
        $this->assertTrue($this->type->isPropertyType());
    }

    /**
     * @test
     */
    public function double_types_can_be_return_types(): void
    {
        $this->assertTrue($this->type->isReturnType());
    }

    /**
     * @test
     */
    public function double_types_are_assignable_to_double_types(): void
    {
        $this->assertTrue($this->type->isAssignableTo('double'));
    }

    /**
     * @test
     */
    public function double_types_are_assignable_to_float_types(): void
    {
        $this->assertTrue($this->type->isAssignableTo('float'));
    }

    /**
     * @test
     */
    public function double_types_are_not_assignable_to_other_scalar_types(): void
    {
        $this->assertFalse($this->type->isAssignableTo('int'));
        $this->assertFalse($this->type->isAssignableTo('string'));
    }

    /**
     * @test
     */
    public function double_types_are_not_assignable_to_compound_types(): void
    {
        $this->assertFalse($this->type->isAssignableTo('array'));
        $this->assertFalse($this->type->isAssignableTo('object'));
        $this->assertFalse($this->type->isAssignableTo('callable'));
        $this->assertFalse($this->type->isAssignableTo('iterable'));
    }

    /**
     * @test
     */
    public function double_types_are_not_assignable_to_other_special_types(): void
    {
        $this->assertFalse($this->type->isAssignableTo('resource'));
        $this->assertFalse($this->type->isAssignableTo('false'));
        $this->assertFalse($this->type->isAssignableTo('true'));
        $this->assertFalse($this->type->isAssignableTo('null'));
    }

    /**
     * @test
     */
    public function double_types_are_not_assignable_to_classes(): void
    {
        $this->assertFalse($this->type->isAssignableTo(BasicClass::class));
        $this->assertFalse($this->type->isAssignableTo(BasicInterface::class));
        $this->assertFalse($this->type->isAssignableTo(BasicTrait::class));
        $this->assertFalse($this->type->isAssignableTo(BasicEnum::class));
    }

    /**
     * @test
     */
    public function double_types_are_not_assignable_to_stringable_classes(): void
    {
        $this->assertFalse($this->type->isAssignableTo(Stringable::class));
    }

    /**
     * @test
     */
    public function double_types_are_not_assignable_to_traversable_classes(): void
    {
        $this->assertFalse($this->type->isAssignableTo(Traversable::class));
    }

    /**
     * @test
     */
    public function double_types_are_not_assignable_from_double_types(): void
    {
        $this->assertTrue($this->type->isAssignableFrom('double'));
    }

    /**
     * @test
     */
    public function double_types_are_assignable_from_float_types(): void
    {
        $this->assertTrue($this->type->isAssignableFrom('float'));
    }

    /**
     * @test
     */
    public function double_types_are_not_assignable_from_scalar_types(): void
    {
        $this->assertFalse($this->type->isAssignableFrom('int'));
        $this->assertFalse($this->type->isAssignableFrom('string'));
    }

    /**
     * @test
     */
    public function double_types_are_not_assignable_from_compound_types(): void
    {
        $this->assertFalse($this->type->isAssignableFrom('array'));
        $this->assertFalse($this->type->isAssignableFrom('object'));
        $this->assertFalse($this->type->isAssignableFrom('callable'));
        $this->assertFalse($this->type->isAssignableFrom('iterable'));
    }

    /**
     * @test
     */
    public function double_types_are_not_assignable_from_other_special_types(): void
    {
        $this->assertFalse($this->type->isAssignableFrom('resource'));
        $this->assertFalse($this->type->isAssignableFrom('false'));
        $this->assertFalse($this->type->isAssignableFrom('true'));
        $this->assertFalse($this->type->isAssignableFrom('null'));
    }

    /**
     * @test
     */
    public function double_types_are_not_assignable_from_classes(): void
    {
        $this->assertFalse($this->type->isAssignableFrom(BasicClass::class));
        $this->assertFalse($this->type->isAssignableFrom(BasicInterface::class));
        $this->assertFalse($this->type->isAssignableFrom(BasicTrait::class));
        $this->assertFalse($this->type->isAssignableFrom(BasicEnum::class));
    }

    /**
     * @test
     */
    public function double_types_are_not_assignable_from_stringable_classes(): void
    {
        $this->assertFalse($this->type->isAssignableFrom(Stringable::class));
    }

    /**
     * @test
     */
    public function double_types_are_not_assignable_from_traversable_classes(): void
    {
        $this->assertFalse($this->type->isAssignableFrom(Traversable::class));
    }

    /**
     * @test
     */
    public function double_types_are_of_type_float(): void
    {
        $this->assertTrue($this->type->isOfType(5.6));
    }

    /**
     * @test
     */
    public function double_types_are_not_of_scalar_types(): void
    {
        $this->assertFalse($this->type->isOfType(36));
        $this->assertFalse($this->type->isOfType('I am a string'));
    }

    /**
     * @test
     */
    public function double_types_are_not_of_compound_types(): void
    {
        $this->assertFalse($this->type->isOfType([]));
        $this->assertFalse($this->type->isOfType(new stdClass));
        $this->assertFalse($this->type->isOfType(fn() => false));
    }

    /**
     * @test
     */
    public function double_types_are_not_of_other_special_types(): void
    {
        $this->assertFalse($this->type->isOfType(fopen(__DIR__ . '/../../README.md', 'rb+')));
        $this->assertFalse($this->type->isOfType(false));
        $this->assertFalse($this->type->isOfType(true));
        $this->assertFalse($this->type->isOfType(null));
    }

    /**
     * @test
     */
    public function double_types_are_not_of_class_types(): void
    {
        $this->assertFalse($this->type->isOfType(new BasicClass));
        $this->assertFalse($this->type->isOfType(BasicEnum::ONE));
    }

    /**
     * @test
     */
    public function double_types_are_not_of_stringable_class_types(): void
    {
        $this->assertFalse($this->type->isOfType(new StringableClass));
    }

    /**
     * @test
     */
    public function double_types_are_not_of_traversable_class_types(): void
    {
        $this->assertFalse($this->type->isOfType(new IterableClass));
    }
}