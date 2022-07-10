<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Classes;

use Smpl\Typing\Concerns\IsClassType;
use Smpl\Typing\Contracts\ClassType as ClassTypeContract;

class TraitType implements ClassTypeContract
{
    use IsClassType;

    /**
     * @param class-string $className
     */
    public function __construct(string $className)
    {
        $this->setClassName($className);
    }

    public function isPropertyType(): bool
    {
        return false;
    }

    public function isParameterType(): bool
    {
        return false;
    }

    public function isTrait(): bool
    {
        return true;
    }
}