<?php

declare(strict_types=1);

namespace Smpl\Typing\Tests\Primitives\Compound;

use PHPUnit\Framework\TestCase;
use Smpl\Typing\Contracts\ChildType;
use Smpl\Typing\Contracts\Type;
use Smpl\Typing\Tests\Fixtures\BasicClass;
use Smpl\Typing\Tests\Fixtures\BasicEnum;
use Smpl\Typing\Tests\Fixtures\BasicInterface;
use Smpl\Typing\Tests\Fixtures\BasicTrait;
use Smpl\Typing\Tests\Fixtures\IterableClass;
use Smpl\Typing\Tests\Fixtures\StringableClass;
use Smpl\Typing\Types;
use stdClass;
use Stringable;
use Traversable;
use function Smpl\Typing\type_of;

/**
 * @group types
 * @group primitives
 * @group compound
 * @group object
 */
class ObjectTypeTest extends TestCase
{
    private Type $type;

    protected function setUp(): void
    {
        $this->type = type_of('object');
    }

    /**
     * @test
     */
    public function object_types_are_named_object(): void
    {
        $this->assertEquals('object', $this->type->getName());
    }

    /**
     * @test
     */
    public function object_types_use_their_name_when_cast_to_a_string(): void
    {
        $this->assertEquals('object', (string)$this->type);
    }

    /**
     * @test
     */
    public function object_types_are_native(): void
    {
        $this->assertTrue($this->type->isNative());
    }

    /**
     * @test
     */
    public function object_types_are_not_nullable(): void
    {
        $this->assertFalse($this->type->isNullable());
    }

    /**
     * @test
     */
    public function object_types_are_primitive(): void
    {
        $this->assertTrue($this->type->isPrimitive());
    }

    /**
     * @test
     */
    public function object_types_are_not_scalar(): void
    {
        $this->assertFalse($this->type->isScalar());
    }

    /**
     * @test
     */
    public function object_types_are_compound(): void
    {
        $this->assertTrue($this->type->isCompound());
    }

    /**
     * @test
     */
    public function object_types_are_not_special(): void
    {
        $this->assertFalse($this->type->isSpecial());
    }

    /**
     * @test
     */
    public function object_types_are_builtin(): void
    {
        $this->assertTrue($this->type->isBuiltin());
    }

    /**
     * @test
     */
    public function object_types_are_not_internal(): void
    {
        $this->assertFalse($this->type->isInternal());
    }

    /**
     * @test
     */
    public function object_types_are_not_user_defined(): void
    {
        $this->assertFalse($this->type->isUserDefined());
    }

    /**
     * @test
     */
    public function object_types_are_standalone_types(): void
    {
        $this->assertTrue($this->type->isStandaloneType());
    }

    /**
     * @test
     */
    public function object_types_are_native_standalone_types(): void
    {
        $this->assertTrue($this->type->isNativeStandaloneType());
    }

    /**
     * @test
     */
    public function object_types_can_be_parameter_types(): void
    {
        $this->assertTrue($this->type->isParameterType());
    }

    /**
     * @test
     */
    public function object_types_can_be_property_types(): void
    {
        $this->assertTrue($this->type->isPropertyType());
    }

    /**
     * @test
     */
    public function object_types_can_be_return_types(): void
    {
        $this->assertTrue($this->type->isReturnType());
    }

    /**
     * @test
     */
    public function object_types_are_assignable_to_object_types(): void
    {
        $this->assertTrue($this->type->isAssignableTo('object'));
    }

    /**
     * @test
     */
    public function object_types_are_not_assignable_to_scalar_types(): void
    {
        $this->assertFalse($this->type->isAssignableTo('bool'));
        $this->assertFalse($this->type->isAssignableTo('string'));
        $this->assertFalse($this->type->isAssignableTo('int'));;
        $this->assertFalse($this->type->isAssignableTo('float'));
    }

    /**
     * @test
     */
    public function object_types_are_not_assignable_to_other_compound_types(): void
    {
        $this->assertFalse($this->type->isAssignableTo('array'));
        $this->assertFalse($this->type->isAssignableTo('iterable'));
        $this->assertFalse($this->type->isAssignableTo('callable'));
    }

    /**
     * @test
     */
    public function object_types_are_not_assignable_to_special_types(): void
    {
        $this->assertFalse($this->type->isAssignableTo('resource'));
        $this->assertFalse($this->type->isAssignableTo('null'));
        $this->assertFalse($this->type->isAssignableTo('false'));
        $this->assertFalse($this->type->isAssignableTo('true'));
    }

    /**
     * @test
     */
    public function object_types_are_not_assignable_to_classes(): void
    {
        $this->assertFalse($this->type->isAssignableTo(BasicClass::class));
        $this->assertFalse($this->type->isAssignableTo(BasicInterface::class));
        $this->assertFalse($this->type->isAssignableTo(BasicTrait::class));
        $this->assertFalse($this->type->isAssignableTo(BasicEnum::class));
    }

    /**
     * @test
     */
    public function object_types_are_not_assignable_to_stringable_classes(): void
    {
        $this->assertFalse($this->type->isAssignableTo(Stringable::class));
    }

    /**
     * @test
     */
    public function object_types_are_not_assignable_to_traversable_classes(): void
    {
        $this->assertFalse($this->type->isAssignableTo(Traversable::class));
    }

    /**
     * @test
     */
    public function object_types_are_assignable_from_object_types(): void
    {
        $this->assertTrue($this->type->isAssignableFrom('object'));
    }

    /**
     * @test
     */
    public function object_types_are_not_assignable_from_scalar_types(): void
    {
        $this->assertFalse($this->type->isAssignableFrom('bool'));
        $this->assertFalse($this->type->isAssignableFrom('string'));
        $this->assertFalse($this->type->isAssignableFrom('int'));
        $this->assertFalse($this->type->isAssignableFrom('float'));
    }

    /**
     * @test
     */
    public function object_types_are_not_assignable_from_other_compound_types(): void
    {
        $this->assertFalse($this->type->isAssignableFrom('array'));
        $this->assertFalse($this->type->isAssignableFrom('iterable'));
        $this->assertFalse($this->type->isAssignableFrom('callable'));
    }

    /**
     * @test
     */
    public function object_types_are_not_assignable_from_special_types(): void
    {
        $this->assertFalse($this->type->isAssignableFrom('resource'));
        $this->assertFalse($this->type->isAssignableFrom('null'));
        $this->assertFalse($this->type->isAssignableFrom('false'));
        $this->assertFalse($this->type->isAssignableFrom('true'));
    }

    /**
     * @test
     */
    public function object_types_are_assignable_from_classes(): void
    {
        $this->assertTrue($this->type->isAssignableFrom(BasicClass::class));
        $this->assertTrue($this->type->isAssignableFrom(BasicInterface::class));
        $this->assertTrue($this->type->isAssignableFrom(BasicTrait::class));
        $this->assertTrue($this->type->isAssignableFrom(BasicEnum::class));
    }

    /**
     * @test
     */
    public function object_types_are_assignable_from_stringable_classes(): void
    {
        $this->assertTrue($this->type->isAssignableFrom(Stringable::class));
    }

    /**
     * @test
     */
    public function object_types_are_assignable_from_traversable_classes(): void
    {
        $this->assertTrue($this->type->isAssignableFrom(Traversable::class));
    }

    /**
     * @test
     */
    public function object_types_are_of_type_object(): void
    {
        $this->assertTrue($this->type->isOfType(new stdClass()));
    }

    /**
     * @test
     */
    public function object_types_are_not_of_scalar_types(): void
    {
        $this->assertFalse($this->type->isOfType(false));
        $this->assertFalse($this->type->isOfType('A string'));
        $this->assertFalse($this->type->isOfType(12345));
        $this->assertFalse($this->type->isOfType(123.45));
    }

    /**
     * @test
     */
    public function object_types_are_not_of_other_compound_types(): void
    {
        $this->assertFalse($this->type->isOfType([]));
        $this->assertFalse($this->type->isOfType([Types::class, 'getInstance']));
    }

    /**
     * @test
     */
    public function object_types_are_not_of_special_types(): void
    {
        $this->assertFalse($this->type->isOfType(fopen(__DIR__ . '/../../../README.md', 'rb+')));
        $this->assertFalse($this->type->isOfType(null));
        $this->assertFalse($this->type->isOfType(false));
        $this->assertFalse($this->type->isOfType(true));
    }

    /**
     * @test
     */
    public function object_types_are_of_class_types(): void
    {
        $this->assertTrue($this->type->isOfType(new BasicClass));
        $this->assertTrue($this->type->isOfType(BasicEnum::ONE));
    }

    /**
     * @test
     */
    public function object_types_are_of_stringable_class_types(): void
    {
        $this->assertTrue($this->type->isOfType(new StringableClass));
    }

    /**
     * @test
     */
    public function object_types_are_of_traversable_class_types(): void
    {
        $this->assertTrue($this->type->isOfType(new IterableClass));
    }
}