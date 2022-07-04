<?php

declare(strict_types=1);

namespace Smpl\Typing\Tests\Fixtures;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

class IterableClass implements IteratorAggregate
{
    public function getIterator(): Traversable
    {
        return new ArrayIterator([]);
    }
}