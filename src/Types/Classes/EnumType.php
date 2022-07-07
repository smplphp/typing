<?php

declare(strict_types=1);

namespace Smpl\Typing\Types\Classes;

use Smpl\Typing\Concerns\IsClassType;
use Smpl\Typing\Contracts\ClassType as ClassTypeContract;

class EnumType implements ClassTypeContract
{
    use IsClassType;

    private string $className;

    public function __construct(string $className)
    {
        $this->className = $className;
    }

    public function getName(): string
    {
        return $this->className;
    }

    public function isEnum(): bool
    {
        return true;
    }
}