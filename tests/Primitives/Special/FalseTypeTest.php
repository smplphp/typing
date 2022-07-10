<?php

declare(strict_types=1);

namespace Smpl\Typing\Tests\Primitives\Special;

use PHPUnit\Framework\TestCase;
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
 * @group special
 * @group bool
 * @group false
 */
class FalseTypeTest extends TestCase
{
    private Type $type;

    protected function setUp(): void
    {
        $this->type = type_of('false');
    }

    /**
     * @test
     */
    public function false_types_are_named_false(): void
    {
        $this->assertEquals('false', $this->type->getName());
    }

    /**
     * @test
     */
    public function false_types_use_their_name_when_cast_to_a_string(): void
    {
        $this->assertEquals('false', (string)$this->type);
    }

    /**
     * @test
     */
    public function false_types_are_native(): void
    {
        $this->assertTrue($this->type->isNative());
    }

    /**
     * @test
     */
    public function false_types_are_not_nullable(): void
    {
        $this->assertFalse($this->type->isNullable());
    }

    /**
     * @test
     */
    public function false_types_are_primitive(): void
    {
        $this->assertTrue($this->type->isPrimitive());
    }

    /**
     * @test
     */
    public function false_types_are_not_scalar(): void
    {
        $this->assertFalse($this->type->isScalar());
    }

    /**
     * @test
     */
    public function false_types_are_not_compound(): void
    {
        $this->assertFalse($this->type->isCompound());
    }

    /**
     * @test
     */
    public function false_types_are_special(): void
    {
        $this->assertTrue($this->type->isSpecial());
    }

    /**
     * @test
     */
    public function false_types_are_builtin(): void
    {
        $this->assertTrue($this->type->isBuiltin());
    }

    /**
     * @test
     */
    public function false_types_are_not_internal(): void
    {
        $this->assertFalse($this->type->isInternal());
    }

    /**
     * @test
     */
    public function false_types_are_not_user_defined(): void
    {
        $this->assertFalse($this->type->isUserDefined());
    }

    /**
     * @test
     */
    public function false_types_are_standalone_types(): void
    {
        $this->assertTrue($this->type->isStandaloneType());
    }

    /**
     * @test
     */
    public function false_types_are_not_native_standalone_types(): void
    {
        $this->assertFalse($this->type->isNativeStandaloneType());
    }

    /**
     * @test
     */
    public function false_types_can_be_parameter_types(): void
    {
        $this->assertTrue($this->type->isParameterType());
    }

    /**
     * @test
     */
    public function false_types_can_be_property_types(): void
    {
        $this->assertTrue($this->type->isPropertyType());
    }

    /**
     * @test
     */
    public function false_types_can_be_return_types(): void
    {
        $this->assertTrue($this->type->isReturnType());
    }

    /**
     * @test
     */
    public function false_types_are_assignable_to_false_types(): void
    {
        $this->assertTrue($this->type->isAssignableTo('false'));
    }

    /**
     * @test
     */
    public function false_types_are_assignable_to_bool_types(): void
    {
        $this->assertTrue($this->type->isAssignableTo('bool'));
    }

    /**
     * @test
     */
    public function false_types_are_not_assignable_to_other_scalar_types(): void
    {
        $this->assertFalse($this->type->isAssignableTo('int'));
        $this->assertFalse($this->type->isAssignableTo('float'));
        $this->assertFalse($this->type->isAssignableTo('string'));
    }

    /**
     * @test
     */
    public function false_types_are_not_assignable_to_compound_types(): void
    {
        $this->assertFalse($this->type->isAssignableTo('array'));
        $this->assertFalse($this->type->isAssignableTo('object'));
        $this->assertFalse($this->type->isAssignableTo('callable'));
        $this->assertFalse($this->type->isAssignableTo('iterable'));
    }

    /**
     * @test
     */
    public function false_types_are_not_assignable_to_other_special_types(): void
    {
        $this->assertFalse($this->type->isAssignableTo('resource'));
        $this->assertFalse($this->type->isAssignableTo('true'));
        $this->assertFalse($this->type->isAssignableTo('null'));
    }

    /**
     * @test
     */
    public function false_types_are_not_assignable_to_classes(): void
    {
        $this->assertFalse($this->type->isAssignableTo(BasicClass::class));
        $this->assertFalse($this->type->isAssignableTo(BasicInterface::class));
        $this->assertFalse($this->type->isAssignableTo(BasicTrait::class));
        $this->assertFalse($this->type->isAssignableTo(BasicEnum::class));
    }

    /**
     * @test
     */
    public function false_types_are_not_assignable_to_stringable_classes(): void
    {
        $this->assertFalse($this->type->isAssignableTo(Stringable::class));
    }

    /**
     * @test
     */
    public function false_types_are_not_assignable_to_traversable_classes(): void
    {
        $this->assertFalse($this->type->isAssignableTo(Traversable::class));
    }

    /**
     * @test
     */
    public function false_types_are_assignable_from_false_types(): void
    {
        $this->assertTrue($this->type->isAssignableFrom('false'));
    }

    /**
     * @test
     */
    public function false_types_are_assignable_from_bool_types(): void
    {
        $this->assertTrue($this->type->isAssignableFrom('bool'));
    }

    /**
     * @test
     */
    public function false_types_are_not_assignable_from_other_scalar_types(): void
    {
        $this->assertFalse($this->type->isAssignableFrom('int'));
        $this->assertFalse($this->type->isAssignableFrom('float'));
        $this->assertFalse($this->type->isAssignableFrom('string'));
    }

    /**
     * @test
     */
    public function false_types_are_not_assignable_from_compound_types(): void
    {
        $this->assertFalse($this->type->isAssignableFrom('array'));
        $this->assertFalse($this->type->isAssignableFrom('object'));
        $this->assertFalse($this->type->isAssignableFrom('callable'));
        $this->assertFalse($this->type->isAssignableFrom('iterable'));
    }

    /**
     * @test
     */
    public function false_types_are_not_assignable_from_other_special_types(): void
    {
        $this->assertFalse($this->type->isAssignableFrom('resource'));
        $this->assertFalse($this->type->isAssignableFrom('true'));
        $this->assertFalse($this->type->isAssignableFrom('null'));
    }

    /**
     * @test
     */
    public function false_types_are_not_assignable_from_classes(): void
    {
        $this->assertFalse($this->type->isAssignableFrom(BasicClass::class));
        $this->assertFalse($this->type->isAssignableFrom(BasicInterface::class));
        $this->assertFalse($this->type->isAssignableFrom(BasicTrait::class));
        $this->assertFalse($this->type->isAssignableFrom(BasicEnum::class));
    }

    /**
     * @test
     */
    public function false_types_are_not_assignable_from_stringable_classes(): void
    {
        $this->assertFalse($this->type->isAssignableFrom(Stringable::class));
    }

    /**
     * @test
     */
    public function false_types_are_not_assignable_from_traversable_classes(): void
    {
        $this->assertFalse($this->type->isAssignableFrom(Traversable::class));
    }

    /**
     * @test
     */
    public function false_types_are_of_type_false(): void
    {
        $this->assertTrue($this->type->isOfType(false));
    }

    /**
     * @test
     */
    public function false_types_are_not_of_type_true(): void
    {
        $this->assertFalse($this->type->isOfType(true));
    }

    /**
     * @test
     */
    public function false_types_are_not_of_scalar_types(): void
    {
        $this->assertFalse($this->type->isOfType(36));
        $this->assertFalse($this->type->isOfType(2.5));
        $this->assertFalse($this->type->isOfType('I am a string'));
    }

    /**
     * @test
     */
    public function false_types_are_not_of_compound_types(): void
    {
        $this->assertFalse($this->type->isOfType([]));
        $this->assertFalse($this->type->isOfType(new stdClass));
        $this->assertFalse($this->type->isOfType(fn() => false));
    }

    /**
     * @test
     */
    public function false_types_are_not_of_other_special_types(): void
    {
        $this->assertFalse($this->type->isOfType(fopen(__DIR__ . '/../../../README.md', 'rb+')));
        $this->assertFalse($this->type->isOfType(true));
        $this->assertFalse($this->type->isOfType(null));
    }

    /**
     * @test
     */
    public function false_types_are_not_of_class_types(): void
    {
        $this->assertFalse($this->type->isOfType(new BasicClass));
        $this->assertFalse($this->type->isOfType(BasicEnum::ONE));
    }

    /**
     * @test
     */
    public function false_types_are_not_of_stringable_class_types(): void
    {
        $this->assertFalse($this->type->isOfType(new StringableClass));
    }

    /**
     * @test
     */
    public function false_types_are_not_of_traversable_class_types(): void
    {
        $this->assertFalse($this->type->isOfType(new IterableClass));
    }
}