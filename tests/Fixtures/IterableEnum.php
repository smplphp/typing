<?php

declare(strict_types=1);

namespace Smpl\Typing\Tests\Fixtures;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

enum IterableEnum implements IteratorAggregate
{
    case ONE;
    case TWO;

    public function getIterator(): Traversable
    {
        return new ArrayIterator(IterableEnum::cases());
    }
}