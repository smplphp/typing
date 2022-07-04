<?php

declare(strict_types=1);

namespace Smpl\Typing\Tests\Fixtures;

use Stringable;

class StringableClass implements Stringable
{
    public function __toString(): string
    {
        return 'stringable-class';
    }
}